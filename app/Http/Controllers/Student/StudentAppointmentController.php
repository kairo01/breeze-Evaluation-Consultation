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
        $users = User::whereIn('role', ['Guidance', 'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 'TesdaDepartment', 'HmDepartment'])->get();
        $pendingAppointment = Appointment::where('student_id', auth()->id())
                                     ->where('status', 'Pending')
                                     ->exists();
        return view('Student.Consform.Appointment', compact('users', 'pendingAppointment'));
    }

    public function store(Request $request)
    {
        $pendingAppointment = Appointment::where('student_id', auth()->id())
                             ->where('status', 'Pending')
                             ->exists();
        if ($pendingAppointment) {
            return redirect()->back()->with('error', 'You already have a pending appointment. Please wait for it to be approved before making a new one.');
        }

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
        $consultantId = $request->input('consultant_role');

        // Check if the student has already made an appointment this week
        $startOfWeek = Carbon::parse($date)->startOfWeek();
        $endOfWeek = Carbon::parse($date)->endOfWeek();

        $existingAppointment = Appointment::where('student_id', auth()->id())
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->first();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'You can only make one appointment per week. Your next available appointment date is ' . $endOfWeek->addDay()->format('M d, Y') . '.');
        }

        $availableSlotsResponse = $this->getAvailableTimeSlots(new Request([
            'date' => $date,
            'consultant_id' => $consultantId
        ]));

        $availableSlots = $availableSlotsResponse->getData(true);

        if (isset($availableSlots['error'])) {
            return redirect()->back()->with('error', $availableSlots['error']);
        }

        if (!in_array($timeSlot, $availableSlots['availableSlots'])) {
            return redirect()->back()->with('error', 'The selected time slot is no longer available. Please choose another.');
        }

        try {
            $appointment = Appointment::create([
                'student_id' => auth()->id(),
                'consultant_role' => $consultantId,
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
                'user_id' => $consultantId,
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
            $consultantId = $request->input('consultant_id');

            if (!$date || !$consultantId) {
                return response()->json(['error' => 'Missing date or consultant ID'], 400);
            }

            $availableSlots = $this->generateAvailableTimeSlots($date, $consultantId);

            return response()->json(['availableSlots' => $availableSlots]);
        } catch (\Exception $e) {
            \Log::error('Error in getAvailableTimeSlots: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching time slots'], 500);
        }
    }

    private function generateAvailableTimeSlots($date, $consultantId)
    {
        // Generate time slots from 8 AM to 5 PM
        $allSlots = [];
        $start = Carbon::parse($date)->setTime(8, 0);
        $end = Carbon::parse($date)->setTime(17, 0);

        while ($start < $end) {
            $allSlots[] = $start->format('H:i');
            $start->addMinutes(30);
        }

        // Get booked appointments for the given date and consultant
        $bookedAppointments = Appointment::where('consultant_role', $consultantId)
            ->whereDate('date', $date)
            ->where('status', '!=', 'Declined')
            ->get()
            ->flatMap(function ($appointment) {
                $start = Carbon::parse($appointment->date->format('Y-m-d') . ' ' . $appointment->time->format('H:i'));
                return [
                    $start->format('H:i'),
                    $start->addMinutes(30)->format('H:i'),
                ];
            })
            ->unique()
            ->values()
            ->toArray();

        // Remove booked slots from available slots
        $availableSlots = array_diff($allSlots, $bookedAppointments);

        return array_values($availableSlots);
    }

    private function getBookedSlots($date, $consultantId)
    {
        try {
            return Appointment::whereDate('date', $date)
                ->where('consultant_role', $consultantId)
                ->where('status', '!=', 'Declined')
                ->get()
                ->flatMap(function ($appointment) {
                    $start = Carbon::parse($appointment->date->format('Y-m-d') . ' ' . $appointment->time->format('H:i'));
                    return [
                        $start->format('H:i'),
                        $start->addMinutes(30)->format('H:i'),
                    ];
                })
                ->unique()
                ->values()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error in getBookedSlots: ' . $e->getMessage(), [
                'date' => $date,
                'consultant_id' => $consultantId,
                'trace' => $e->getTraceAsString()
            ]);
            return [];
        }
    }

    private function getBusySlots($date, $consultantId)
    {
        try {
            return BusySlot::whereDate('date', $date)
                ->where('consultant_id', $consultantId)
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
                ->values()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error in getBusySlots: ' . $e->getMessage(), [
                'date' => $date,
                'consultant_id' => $consultantId,
                'trace' => $e->getTraceAsString()
            ]);
            return [];
        }
    }

    private function generateTimeSlots()
    {
        $slots = [];
        $start = strtotime('08:00');
        $end = strtotime('17:00');
        while ($start < $end) {
            $slots[] = date('H:i', $start);
            $start = strtotime('+30 minutes', $start);
        }
        return $slots;
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
            'link' => route('StudentHistory'),
            'appointment_id' => $appointment->id,
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
            'link' => route('StudentHistory'),
            'appointment_id' => $appointment->id,
        ]);

        return redirect()->back()->with('success', 'Appointment declined successfully.');
    }
}

