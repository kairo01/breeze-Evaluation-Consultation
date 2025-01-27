<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentHistoryController extends Controller
{
   public function index(Request $request)
   {
       $query = Appointment::with('consultant')->where('student_id', Auth::id());

       if ($request->has('search')) {
           $search = $request->input('search');
           $query->where(function($q) use ($search) {
               $q->whereHas('consultant', function ($q) use ($search) {
                   $q->where('name', 'like', "%$search%");
               })
               ->orWhere('course', 'like', "%$search%")
               ->orWhere('purpose', 'like', "%$search%")
               ->orWhere('meeting_mode', 'like', "%$search%")
               ->orWhere('status', 'like', "%$search%");
           });
       }

       if ($request->has('sort')) {
           $sort = $request->input('sort');
           $query->orderBy('course', $sort);
       } else {
           $query->orderBy('date', 'desc')->orderBy('time', 'desc');
       }

       $appointments = $query->get();

       // Update the is_completed status for each appointment
       $appointments->each(function ($appointment) {
           $appointment->is_completed = $appointment->getIsCompletedAttribute();
       });

       return view('Student.StudentHistory', compact('appointments'));
   }

   public function updateCompletion(Request $request, Appointment $appointment)
   {
       if ($appointment->student_id !== Auth::id()) {
           return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
       }

       $appointment->is_completed = $request->is_completed;
       $appointment->save();

       return response()->json(['success' => true]);
   }
}

