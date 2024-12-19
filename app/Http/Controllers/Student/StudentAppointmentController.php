<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\BusySlot;
use App\Models\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class StudentAppointmentController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'student')->get();
        return view('Student.Consform.Appointment', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultant_role' => 'required|exists:users,id',
            'course' => 'required|string',
            'purpose' => 'required|in:Transfer Interview,Return to Class Interview,Academic Problem,Graduating Interview and Exit Interview,Counseling',
            'meeting_mode' => 'required|in:Face to Face,Online',
            'meeting_preference' => 'nullable|required_if:meeting_mode,Online|in:Zoom,Whatsapp',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|date_format:H:i',
        ]);

        $date = $request->input('date');
        $timeSlot = $request->input('time_slot');

        // Check if the student has already made an appointment this week
        $startOfWeek = Carbon::parse($date)->startOfWeek();
        $endOfWeek = Carbon::parse($date)->endOfWeek();

        $existingAppointment = Appointment::where('student_id', auth()->id())
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->first();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'You can only make one appointment per week. Your next available appointment date is ' . $endOfWeek->addDay()->format('M d, Y') . '.');
        }

        // Check if the slot is still available
        $availableSlots = $this->getAvailableTimeSlots(new Request(['date' => $date]));
        if (!in_array($timeSlot, $availableSlots->original['availableSlots'])) {
            return redirect()->back()->with('error', 'The selected time slot is no longer available. Please choose another.');
        }

        try {
            $appointment = Appointment::create([
                'student_id' => auth()->id(),
                'consultant_role' => $request->input('consultant_role'),
                'course' => $request->input('course'),
                'purpose' => $request->input('purpose'),
                'meeting_mode' => $request->input('meeting_mode'),
                'meeting_preference' => $request->input('meeting_preference'),
                'date' => $date,
                'time' => $timeSlot,
                'status' => 'Pending',
            ]);

            // Create notification for the consultant
            Notify::create([
                'user_id' => $request->input('consultant_role'),
                'message' => 'New appointment request from ' . auth()->user()->name,
                'type' => 'new_appointment',
                'read' => false,
            ]);

            return redirect()->route('Student.Consform.Appointment')->with('success', 'Appointment successfully created.');
        } catch (\Exception $e) {
            Log::error('Error creating appointment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the appointment. Please try again.');
        }
    }

    public function getAvailableTimeSlots(Request $request)
    {
        try {
            $date = $request->input('date');
            if (!$date) {
                throw new \Exception('Date is required');
            }

            $allSlots = $this->generateTimeSlots();
            $bookedSlots = $this->getBookedSlots($date);
            $busySlots = $this->getBusySlots($date);

            $availableSlots = array_diff($allSlots, $bookedSlots, $busySlots);

            Log::info('Available time slots', [
                'date' => $date,
                'allSlots' => $allSlots,
                'bookedSlots' => $bookedSlots,
                'busySlots' => $busySlots,
                'availableSlots' => $availableSlots
            ]);

            return response()->json(['availableSlots' => array_values($availableSlots)]);
        } catch (\Exception $e) {
            Log::error('Error in getAvailableTimeSlots: ' . $e->getMessage(), [
                'date' => $request->input('date'),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while fetching available time slots: ' . $e->getMessage()], 500);
        }
    }

    private function generateTimeSlots()
    {
        $slots = [];
        for ($hour = 8; $hour < 17; $hour++) {
            $slots[] = sprintf('%02d:00', $hour);
        }
        return $slots;
    }

    private function getBookedSlots($date)
    {
        try {
            return Appointment::whereDate('date', $date)
                ->get()
                ->flatMap(function ($appointment) {
                    $start = $appointment->time->format('H:i');
                    return [
                        $start,
                        date('H:i', strtotime('+30 minutes', strtotime($start))),
                    ];
                })
                ->unique()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error in getBookedSlots: ' . $e->getMessage(), [
                'date' => $date,
                'trace' => $e->getTraceAsString()
            ]);
            return [];
        }
    }

    private function getBusySlots($date)
    {
        try {
            return BusySlot::whereDate('date', $date)
                ->get()
                ->flatMap(function ($busySlot) {
                    if ($busySlot->busy_all_day) {
                        return $this->generateTimeSlots();
                    } else {
                        $start = strtotime($busySlot->from);
                        $end = strtotime($busySlot->to);
                        $slots = [];
                        while ($start < $end) {
                            $slots[] = date('H:i', $start);
                            $start = strtotime('+30 minutes', $start);
                        }
                        return $slots;
                    }
                })
                ->unique()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error in getBusySlots: ' . $e->getMessage(), [
                'date' => $date,
                'trace' => $e->getTraceAsString()
            ]);
            return [];
        }
    }

    public function approve(Appointment $appointment)
    {
        $appointment->status = 'Approved';
        $appointment->save();

        // Send notification to the student
        Notify::create([
            'user_id' => $appointment->student_id,
            'message' => 'Your appointment has been approved.',
            'type' => 'appointment_approved',
            'read' => false,
            'link' => route('student.appointment.show', $appointment->id),
        ]);

        return redirect()->back()->with('success', 'Appointment approved successfully.');
    }

    public function decline(Request $request, Appointment $appointment)
    {
        $appointment->status = 'Declined';
        $appointment->decline_reason = $request->input('decline_reason');
        $appointment->save();

        // Send notification to the student
        Notify::create([
            'user_id' => $appointment->student_id,
            'message' => 'Your appointment has been declined.',
            'type' => 'appointment_declined',
            'read' => false,
            'link' => route('student.appointment.show', $appointment->id),
        ]);

        return redirect()->back()->with('success', 'Appointment declined successfully.');
    }
}

