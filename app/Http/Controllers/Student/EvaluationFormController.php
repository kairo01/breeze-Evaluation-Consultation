<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // Ensure this is imported
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationFormController extends Controller
{
    public function index()
{
    $evaluations = Evaluation::all(); // Fetch all evaluations from the database
    return view('Student.evaluation.evaluationform', compact('evaluations'));
}

    public function create()
    {
        return view('Student.evaluation.evaluationform');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teaching_skills' => 'required|array',
            'facilities' => 'required|array',
        ]);

        Evaluation::create([
            'teacher_name' => $request->teacher_name,
            'subject' => $request->subject,
            'teaching_skills' => json_encode($request->teaching_skills), // Serialize to store in DB
            'facilities' => json_encode($request->facilities), // Serialize to store in DB
        ]);

        return redirect()->route('evaluation.create')->with('success', 'Evaluation submitted successfully.');
    }

    public function show($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return view('Student.evaluation.evaluation.show', compact('evaluation'));
    }
}
