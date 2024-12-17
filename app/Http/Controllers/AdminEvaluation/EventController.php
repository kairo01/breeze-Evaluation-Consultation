<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\User; // Assuming students are stored as users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EvaluationNotification;

class EvaluationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
        ]);

        // Save evaluation to the database
        $evaluation = Evaluation::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
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
