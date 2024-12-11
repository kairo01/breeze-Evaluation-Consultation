<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluationHistoryController extends Controller
{
    public function index()
    
    {
        return view('Evaluation.EvaluationHistory');
    }
}
