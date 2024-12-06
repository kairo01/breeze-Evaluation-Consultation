<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollegeAppointmentController extends Controller
{
    public function index()
    
    {
        return view('Student.Consultation.CollegeAppointment');
    }
}
