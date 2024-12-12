<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HighSchoolPickerController extends Controller
{
    
    public function index()
    {
        return view('Student.evaluation.HighSchoolStudent'); // Adjusted to match the correct view path
    }
}
