<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class StudentHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::where('student_id', Auth::id());

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('consultant', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhere('course', 'like', "%$search%")
          ->orWhere('purpose', 'like', "%$search%")
          ->orWhere('meeting_mode', 'like', "%$search%")
          ->orWhere('status', 'like', "%$search%");
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('course', $sort);
        } else {
            $query->orderBy('date', 'desc')->orderBy('time', 'desc');
        }

        $appointments = $query->get();

        return view('Student.StudentHistory', compact('appointments'));
    }
}

