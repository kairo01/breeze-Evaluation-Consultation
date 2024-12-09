<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class StudentHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())->get();
        return view('Student.StudentHistory', compact('appointments'));
    }
}
