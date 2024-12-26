<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class StudentHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('student_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('Student.StudentHistory', compact('appointments'));
    }
}

