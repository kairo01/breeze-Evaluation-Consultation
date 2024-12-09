<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrPickerController extends Controller
{
    public function index()
    
    {
        return view('HrCollege');
    }

    public function HighSchoolPicker()
    {
        // This returns the view for the High School Picker
        return view('HrHighschool');
    }
}
