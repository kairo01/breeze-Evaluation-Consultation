<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class HighSchoolController extends Controller
{
   
    public function index()
    {
        return view('Student.HighSchoolDashboard'); // Adjusted to match the correct view path
    }
    
}
