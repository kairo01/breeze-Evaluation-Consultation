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
            'student_id' => 'required' ,
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teaching_skills' => 'required|array',
            'facilities' => 'required|array',
            'facilities.*.rating' => 'required|integer|min:1|max:5',
            'facilities.*.comment' => 'nullable|string|max:255',
            'teacher_comment' => 'required|string|max:500',
        ]);
    
        // Prepare data for saving
        $facilitiesData = [];
        foreach ($request->facilities as $facility => $data) {
            $facilitiesData[$facility] = [
                'student_id' => 'required' ,
                'rating' => $data['rating'],
                'comment' => $data['comment'] ?? null,
            ];
        }
    
        Evaluation::create([
            'student_id' => $request->student_id,
            'teacher_name' => $request->teacher_name,
            'subject' => $request->subject,
            'teaching_skills' => $request->teaching_skills,
            'facilities' => $facilitiesData,
            'teacher_comment' => $request->teacher_comment,
        ]);
    
        return redirect()->route('evaluation.create')->with('success', 'Evaluation submitted successfully.');
    }
    
    public function show($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return view('Student.evaluation.evaluation.show', compact('evaluation'));
    }

    
}
