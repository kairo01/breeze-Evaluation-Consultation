<?php

namespace App\Http\Controllers\Student;

use App\Models\Users;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentCalendarController extends Controller
{
    public function index()
{
    // Get the student's approved appointments
    $appointments = Appointment::where('student_id', auth()->id())
                               ->where('status', 'Approved')
                               ->get()
                               ->map(function ($appointment) {
                                   return $appointment->getEventData();
                               });

    return view('Student.StudentCalendar', compact('appointments'));
}

}
