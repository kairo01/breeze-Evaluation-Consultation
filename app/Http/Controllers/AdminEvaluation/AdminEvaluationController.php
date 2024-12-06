<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminEvaluationController extends Controller
{
    public function index()
    
    {
        return view('adminevaluation.hrdashboard');
    }
}
