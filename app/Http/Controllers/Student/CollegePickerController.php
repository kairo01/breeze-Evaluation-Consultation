<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollegePickerController extends Controller
{
    public function index()
    {
        return view('Student.evaluation.CollegeStudent'); // Adjusted to match the correct view path
    }
}
