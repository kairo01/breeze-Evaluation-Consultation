<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; // Ensure this is imported
use App\Models\Evaluation;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EvaluationFormController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all events that have started (start_date <= current time)
        $events = Event::where('start_date', '<=', now('Asia/Manila'))->get();

        // If no events are active, return an error
        if ($events->isEmpty()) {
            return redirect()->back()->with('error', 'No upcoming evaluation set. Please wait for the evaluation to be scheduled.');
        }

        $accessibleEvent = null;

        // Loop through the events to check if the evaluation form is accessible
        foreach ($events as $event) {
            // Calculate the end of the event day (end of the day after the event starts)
            $eventEndOfDay = Carbon::parse($event->start_date)->endOfDay();

            // If the current time is within the event's day, set the event as accessible
            if (Carbon::now('Asia/Manila')->between($event->start_date, $eventEndOfDay)) {
                $accessibleEvent = $event;
                break; // Exit the loop if we find an accessible event
            }
        }

        // If no accessible event is found, return an error
        if (!$accessibleEvent) {
            return redirect()->back()->with('error', 'The event has already passed. Evaluation form is no longer accessible.');
        }
        
        $evaluations = Evaluation::all(); // Fetch all evaluations from the database

        $teacher_name = $request->query('teacher_name');

        return view('Student.evaluation.evaluationform', compact('evaluations', 'teacher_name'));
    }

    public function create(Request $request)
    {

        // Fetch all events that have started (start_date <= current time)
        $events = Event::where('start_date', '<=', now('Asia/Manila'))->get();

        // If no events are active, return an error
        if ($events->isEmpty()) {
            return redirect()->back()->with('error', 'No upcoming evaluation set. Please wait for the evaluation to be scheduled.');
        }

        $accessibleEvent = null;

        // Loop through the events to check if the evaluation form is accessible
        foreach ($events as $event) {
            // Calculate the end of the event day (end of the day after the event starts)
            $eventEndOfDay = Carbon::parse($event->start_date)->endOfDay();

            // If the current time is within the event's day, set the event as accessible
            if (Carbon::now('Asia/Manila')->between($event->start_date, $eventEndOfDay)) {
                $accessibleEvent = $event;
                break; // Exit the loop if we find an accessible event
            }
        }

        // If no accessible event is found, return an error
        if (!$accessibleEvent) {
            return redirect()->back()->with('error', 'The event has already passed. Evaluation form is no longer accessible.');
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
