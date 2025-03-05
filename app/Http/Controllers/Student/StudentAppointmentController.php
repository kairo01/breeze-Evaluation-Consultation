<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\BusySlot;
use App\Models\Notify;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Notifications\NewAppointmentNotification;

class StudentAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $consultants = User::where(function ($query) use ($user) {
            if ($user->student_type === 'HighSchool') {
                $query->where('role', 'HighSchoolDepartment');
            } else {
                $query->whereIn('role', ['Guidance', 'ComputerDepartment', 'EngineeringDeparment', 'TesdaDepartment', 'HmDepartment']);
            }
        })->get();
    
        $pendingAppointment = Appointment::where('student_id', auth()->id())
                                         ->where('status', 'Pending')
                                         ->exists();

        $rescheduleData = null;
        if ($request->has('reschedule') && $request->has('appointment_id')) {
            $rescheduleData = Appointment::findOrFail($request->appointment_id);
        }

        return view('Student.Consform.Appointment', compact('consultants', 'pendingAppointment', 'rescheduleData'));
    }

// Update the store method to add better error handling and debugging
public function store(Request $request)
{
    try {
        $validated = $request->validate([
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

        // Check if the student is rescheduling
        $isRescheduling = $request->has('reschedule') && $request->has('original_appointment_id');

        if (!$isRescheduling) {
            // Check if the student has already made an appointment this week or next two weeks
            $startOfWeek = Carbon::now()->startOfWeek();
            $twoWeeksFromNow = Carbon::now()->addWeeks(2)->endOfWeek();

            $existingAppointment = Appointment::where('student_id', auth()->id())
                ->whereBetween('date', [$startOfWeek, $twoWeeksFromNow])
                ->whereNull('original_appointment_id')
                ->where('status', '!=', 'Declined')
                ->first();

            if ($existingAppointment) {
                return redirect()->back()->with('error', 'You can only make one appointment per week. Your next available appointment date is ' . $twoWeeksFromNow->addDay()->format('M d, Y') . '.');
            }
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

        $appointmentData = [
            'student_id' => auth()->id(),
            'consultant_role' => $consultantId,
            'course' => $request->input('course'),
            'purpose' => $request->input('purpose'),
            'meeting_mode' => $request->input('meeting_mode'),
            'meeting_preference' => $request->input('meeting_preference'),
            'date' => $date,
            'time' => $timeSlot,
            'status' => 'Pending',
        ];

        if ($isRescheduling) {
            $originalAppointmentId = $request->input('original_appointment_id');
            $appointmentData['is_rescheduled'] = true;
            $appointmentData['original_appointment_id'] = $originalAppointmentId;
            
            // Update the original appointment to show it's been rescheduled
            $originalAppointment = Appointment::find($originalAppointmentId);
            if ($originalAppointment) {
                $originalAppointment->is_rescheduled = true;
                $originalAppointment->save();
            }
        }

        $appointment = Appointment::create($appointmentData);

        // Create notification for the consultant
        $consultant = User::find($consultantId);
        $consultant->notify(new NewAppointmentNotification($appointment));

        $message = $isRescheduling ? 'Appointment successfully rescheduled.' : 'Appointment successfully created.';
        return redirect()->route('Student.Consform.Appointment')->with('success', $message);
    } catch (\Exception $e) {
        Log::error('Error creating appointment: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->all()
        ]);
        return redirect()->back()->with('error', 'An error occurred while creating the appointment. Please try again. Error: ' . $e->getMessage());
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

            Log::info('Fetching available time slots', ['date' => $date, 'consultant_id' => $consultantId]);

            $availableSlots = $this->generateAvailableTimeSlots($date, $consultantId);

            Log::info('Available time slots', ['slots' => $availableSlots]);

            return response()->json(['availableSlots' => $availableSlots]);
        } catch (\Exception $e) {
            Log::error('Error in getAvailableTimeSlots: ' . $e->getMessage(), [
                'date' => $request->input('date'),
                'consultant_id' => $request->input('consultant_id'),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while fetching time slots: ' . $e->getMessage()], 500);
        }
    }

    private function generateAvailableTimeSlots($date, $consultantId)
    {
        try {
            // Generate time slots from 8 AM to 5 PM
            $allSlots = [];
            $start = Carbon::parse($date)->setTime(8, 0);
            $end = Carbon::parse($date)->setTime(17, 0);

            while ($start < $end) {
                $allSlots[] = $start->format('H:i');
                $start->addMinutes(30);
            }

            // Get booked appointments for the given date and consultant
            $bookedAppointments = $this->getBookedSlots($date, $consultantId);

            // Get busy slots for the given date and consultant
            $busySlots = $this->getBusySlots($date, $consultantId);

            // Get available slots from consultant's availability
            $availableSlots = $this->getAvailableSlots($date, $consultantId);

            // Combine booked appointments and busy slots
            $unavailableSlots = array_merge($bookedAppointments, $busySlots);

            // Remove unavailable slots from available slots
            $finalAvailableSlots = array_diff($availableSlots, $unavailableSlots);

            return array_values($finalAvailableSlots);
        } catch (\Exception $e) {
            Log::error('Error in generateAvailableTimeSlots: ' . $e->getMessage(), [
                'date' => $date,
                'consultant_id' => $consultantId,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function getAvailableSlots($date, $consultantId)
    {
        $dayOfWeek = Carbon::parse($date)->format('l');
        $availabilities = Availability::where('consultant_id', $consultantId)
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->get();

        $availableSlots = [];

        if ($availabilities->isEmpty()) {
            // If no specific availability is set, consultant is available from 8am to 5pm, Monday to Saturday
            if ($dayOfWeek !== 'Sunday') {
                $start = Carbon::parse($date)->setTime(8, 0);
                $end = Carbon::parse($date)->setTime(17, 0);

                while ($start < $end) {
                    $availableSlots[] = $start->format('H:i');
                    $start->addMinutes(30);
                }
            }
        } else {
            // If specific availability is set, use only those time slots on specified days
            foreach ($availabilities as $availability) {
                $availableDays = is_array($availability->days) ? $availability->days : json_decode($availability->days, true);
                if (in_array($dayOfWeek, $availableDays)) {
                    $start = Carbon::parse($date . ' ' . $availability->from_time->format('H:i:s'));
                    $end = Carbon::parse($date . ' ' . $availability->to_time->format('H:i:s'));

                    while ($start < $end) {
                        $availableSlots[] = $start->format('H:i');
                        $start->addMinutes(30);
                    }
                }
            }
        }

        return array_unique($availableSlots);
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
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function getBusySlots($date, $consultantId)
    {
        try {
            $busySlots = BusySlot::whereDate('date', $date)
                ->where('consultant_id', $consultantId)
                ->get();

            $unavailableSlots = [];

            foreach ($busySlots as $busySlot) {
                if ($busySlot->busy_all_day) {
                    // If it's an all-day busy slot, mark all slots as unavailable
                    $unavailableSlots = $this->generateAllDaySlots();
                    break; // No need to check other slots if there's an all-day busy slot
                } else {
                    $start = Carbon::parse($busySlot->date->format('Y-m-d') . ' ' . $busySlot->from->format('H:i'));
                    $end = Carbon::parse($busySlot->date->format('Y-m-d') . ' ' . $busySlot->to->format('H:i'));

                    while ($start < $end) {
                        $unavailableSlots[] = $start->format('H:i');
                        $start->addMinutes(30);
                    }
                }
            }

            return array_unique($unavailableSlots);
        } catch (\Exception $e) {
            Log::error('Error in getBusySlots: ' . $e->getMessage(), [
                'date' => $date,
                'consultant_id' => $consultantId,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function generateAllDaySlots()
    {
        $allDaySlots = [];
        $start = Carbon::createFromTime(8, 0);
        $end = Carbon::createFromTime(17, 0);

        while ($start < $end) {
            $allDaySlots[] = $start->format('H:i');
            $start->addMinutes(30);
        }

        return $allDaySlots;
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

    // Update the reschedule method to include more data for pre-filling the form
    public function reschedule($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->student_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Mark the old appointment as not completed and rescheduled
        $appointment->not_completed = 1;
        $appointment->is_completed = 0;
        $appointment->is_rescheduled = true; // Set the rescheduled flag
        $appointment->save();

        // Redirect to the appointment form with pre-filled data
        return redirect()->route('Student.Consform.Appointment', [
            'reschedule' => true,
            'appointment_id' => $appointment->id,
            'consultant_id' => $appointment->consultant_role,
            'course' => $appointment->course,
            'purpose' => $appointment->purpose,
            'meeting_mode' => $appointment->meeting_mode,
            'meeting_preference' => $appointment->meeting_preference,
        ]);
    }
}

