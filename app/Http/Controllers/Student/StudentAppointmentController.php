<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade

class StudentAppointmentController extends Controller
{
    /**
     * Display the appointment form.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'student')->get();
        return view('Student.Consform.Appointment',compact('users'));
    }

    /**
     * Store a new appointment.
     */
    public function store(Request $request)
    {
     

        // Validate the request
        $validated = $request->validate([
            'course' => 'required|string',
            'consultant_role' => 'required|exists:users,id',
            'purpose' => 'required|in:Transfer,Return to Class,Academic,Graduating,Personal',
            'meeting_mode' => 'required|in:Face to Face,Online',
            'meeting_preference' => 'nullable|required_if:meeting_mode,Online|in:Zoom,Gmeet',
            'date_time' => 'required|date|after:now',
        ]);

      

        // Create the appointment
        $appointment = Appointment::create([
            'name' => $request->input('name'),
            'student_id' => $request->input('student_id'),
            'consultant_role' => $request->input('consultant_role'),
            'course' =>$request->input('course'),
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
