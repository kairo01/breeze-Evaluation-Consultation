<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\User;  // Make sure to import the User model for notifications
use App\Notifications\EvaluationNotification;  // Make sure to import your custom notification
use Illuminate\Http\Request;
use App\Models\Event;

class HrCalendarController extends Controller
{
    public function index()
    
    {
        return view('Evaluation.HrCalendar');
    }

    public function createEvent(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'student_type' => 'required|in:highschool,college',
        ]);

        // Create the event in the database
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start_date,
            'student_type' => 'required|in:highschool,college',
        ]);
       
        // Fetch students based on the selected student type
        $students = User::where('role', 'Student')
            ->where('student_type', $request->student_type)
            ->where('status', 'active')
            ->get();

        // Send notifications to the students
        foreach ($students as $student) {
            $student->notify(new EvaluationNotification($event));
        }

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Evaluation successfully set!',
        ]);
    }
    }
    

