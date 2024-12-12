<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentPickerController extends Controller
{
    public function index()
    
    {
        return view('Student.evaluation.StudentPicker');
    }
}
