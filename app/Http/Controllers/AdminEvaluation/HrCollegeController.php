<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrCollegeController extends Controller
{
    public function index()
    {
        // Your logic here
        return view('Evaluation.HrCollege'); 
    }
}
