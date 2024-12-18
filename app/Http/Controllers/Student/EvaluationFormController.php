<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // Ensure this is imported
use App\Models\Evaluation;
use App\Models\Event;
use Illuminate\Http\Request;

class EvaluationFormController extends Controller
{
    public function index(Request $request)
{
    // Check if there is an active event with start_date in the future
    $event = Event::where('start_date', '<=', now('Asia/Manila'))->first();

    // If no active event, return an error or redirect
    if (!$event) {
        return redirect()->back()->with('error', 'No upcoming evaluation set. Please wait for the evaluation to be scheduled.');
    }
    
    $evaluations = Evaluation::all(); // Fetch all evaluations from the database

    $teacher_name = $request->query('teacher_name');

    return view('Student.evaluation.evaluationform', compact('evaluations', 'teacher_name'));
}

    public function create(Request $request)
    {

        // Check if there is an active event with start_date in the future
        $event = Event::where('start_date', '<=', now('Asia/Manila'))->first();

        // If no active event, return an error or redirect
        if (!$event) {
            return redirect()->back()->with('error', 'No upcoming evaluation set. Please wait for the evaluation to be scheduled.');
        }
        
        $teacher_name = $request->query('teacher_name');

        return view('Student.evaluation.evaluationform', compact('teacher_name'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'teaching_skills' => 'required|array',
            'facilities' => 'required|array',
            'facilities.*.rating' => 'required|integer|min:1|max:5',
            'facilities.*.comment' => 'nullable|string|max:255',
            'teacher_comment' => 'required|string|max:500',
        ]);
    
        // Prepare facilities data
        $facilitiesData = [];
        foreach ($request->facilities as $facility => $data) {
            $facilitiesData[$facility] = [
                'rating' => $data['rating'],
                'comment' => $data['comment'] ?? null,
            ];
        }
    
        // Save data into the database
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
