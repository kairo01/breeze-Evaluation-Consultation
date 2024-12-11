<?php
namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationHistoryController extends Controller
{
    public function showForm()
    {

        return view('Student.evaluation.evaluationform');

        return view('Evaluation.EvaluationHistory');
        }
    


    
}
