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


    public function submit(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teaching_skills.*' => 'required|integer|between:1,5',
            'facilities.*' => 'required|integer|between:1,5',
        ]);
    
        // Persist data into database if needed
        Evaluation::create([
            'teacher_name' => $validated['teacher_name'],
            'subject' => $validated['subject'],
            'teaching_skills' => json_encode($validated['teaching_skills']), // Store arrays as JSON
            'facilities' => json_encode($validated['facilities']), // Store arrays as JSON
        ]);
    
        // Redirect back with a success message
        return back()->with('success', 'Evaluation submitted successfully!');
    }
    
}
