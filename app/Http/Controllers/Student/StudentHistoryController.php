<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class StudentHistoryController extends Controller
{
    /**
     * Display the student's appointment history.
     */
    public function index()
    {
        $appointments = Appointment::where('student_id', auth()->id())
            ->get();

        return view('Student.StudentHistory', compact('appointments'));
    }
}
