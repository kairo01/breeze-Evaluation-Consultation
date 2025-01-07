<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\User; // Assuming students are stored as users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EvaluationNotification;
use Carbon\Carbon;

class EvaluationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:now', // Prevent past dates
            'student_type' => 'required|in:highschool,college',
        ]);

        $year = Carbon::parse($request->input('start_date'))->year;

        if (Event::whereYear('start_date', $year)->exists()) {
            return back()->with('error', 'The Evaluation for this year already exists.');
        }

        // Save evaluation to the database
        $evaluation = Evaluation::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->input('start_date'),
            'student_type' => $request->input('student_type'),
        ]);

        // Notify all students (adjust as necessary)
        $students = User::where('role', 'student')->get(); // Filter based on role
        Notification::send($students, new EvaluationNotification($evaluation));

        return response()->json([
            'success' => true,
            'event' => $evaluation,
        ]);
    }
}
