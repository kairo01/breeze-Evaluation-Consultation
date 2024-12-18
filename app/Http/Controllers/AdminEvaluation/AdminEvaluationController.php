<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class AdminEvaluationController extends Controller
{
    public function index()
    {
        // Count the unique students who have filled out the evaluation form
        $totalEvaluations = Evaluation::distinct('student_id')->count('student_id');

        // Pass the count to the view
        return view('Evaluation.HrDashboard', compact('totalEvaluations'));
    }
}
