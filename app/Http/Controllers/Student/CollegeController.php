<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class CollegeController extends Controller
{
   
    public function index()
    {
        return view('Student.CollegeDashboard'); // Adjusted to match the correct view path
    }
}
