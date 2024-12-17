<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\BusySlot; // Import BusySlot model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Facades\Log; // Import Log facade

class StudentAppointmentController extends Controller
{
    /**
     * Display the appointment form.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'student')->get();
        return view('Student.Consform.Appointment', compact('users'));
    }

    /**
     * Store a new appointment.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'consultant_role' => 'required|exists:users,id',
            'course' => 'required|string',
            'purpose' => 'required|in:Transfer Interview,Return to Class Interview,Academic Problem,Graduating Interview and Exit Interview,Counseling',
            'meeting_mode' => 'required|in:Face to Face,Online',
            'meeting_preference' => 'nullable|required_if:meeting_mode,Online|in:Zoom,Whatsapp',
            'date_time' => 'required|date|after:now',
        ]);

        // Check for conflicts
        $startTime = $request->input('date_time');
        $endTime = date('Y-m-d H:i:s', strtotime($startTime) + 3600); // 1 hour later

        $conflict = Appointment::where('consultant_role', $request->input('consultant_role'))
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('date_time', [$startTime, $endTime])
                      ->orWhereBetween(DB::raw('DATE_ADD(date_time, INTERVAL 1 HOUR)'), [$startTime, $endTime]);
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['date_time' => 'The selected time conflicts with an existing appointment.']);
        }

        // Check for busy slots
        $busyConflict = BusySlot::where('consultant_role', $request->input('consultant_role'))
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('date', [$startTime, $endTime])
                      ->orWhereBetween(DB::raw('DATE_ADD(date, INTERVAL 1 HOUR)'), [$startTime, $endTime]);
            })
            ->exists();

        if ($busyConflict) {
            return redirect()->back()->withErrors(['date_time' => 'The selected time conflicts with a busy slot.']);
        }

        // Create the appointment
        Appointment::create([
            'student_id' => auth()->id(),
            'consultant_role' => $request->input('consultant_role'),
            'course' => $request->input('course'),
            'purpose' => $request->input('purpose'),
            'meeting_mode' => $request->input('meeting_mode'),
            'meeting_preference' => $request->input('meeting_preference'),
            'date_time' => $request->input('date_time'),
            'status' => 'Pending',
        ]);

        // Redirect back with success message
        return redirect()->route('Student.Consform.Appointment')->with('success', 'Appointment successfully created.');
    }
}