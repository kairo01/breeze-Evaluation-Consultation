<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class StudentAppointmentController extends Controller
{
    public function index()
    {
        return view('Student.Consultation.Appointment');
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'course' => 'required|string',
        'consultant' => 'required|in:Admin Consultant,Department Head', // Ensure valid consultant value
        'purpose' => 'required|string',
        'meeting_mode' => 'required|string',
        'meeting_preference' => 'nullable|string',
        'appointment_date_time' => 'required|date',
    ]);

    // Create a new appointment using the form data
    Appointment::create([
        'user_id' => Auth::id(), // Store the user ID of the logged-in user
        'name' => Auth::user()->name, // Automatically use the logged-in user's name
        'course' => $request->course,
        'consultant' => $request->consultant,
        'purpose' => $request->purpose,
        'meeting_mode' => $request->meeting_mode,
        'meeting_preference' => $request->meeting_mode == 'Online' ? $request->meeting_preference : null,
        'appointment_date_time' => $request->appointment_date_time,
        'status' => 'Pending', // Default status is pending
    ]);

    // Redirect back to the appointment page with a success message
    return redirect()->route('Student.Consultation.Appointment')
        ->with('status', 'Appointment successfully booked!');
}

}
