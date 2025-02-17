<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationOverallHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::where('consultant_role', Auth::id());

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('course', 'like', "%$search%");
        }

        $programs = $query->distinct('course')
            ->pluck('course')
            ->map(function ($course) {
                return explode('/', $course)[0];
            })->unique()->values();

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $programs = $sort === 'asc' ? $programs->sort() : $programs->sortDesc();
        }

        return view('Consultation.CtOverallHistory', compact('programs'));
    }

    public function showProgramHistory(Request $request, $program)
    {
        $query = Appointment::where('consultant_role', Auth::id())
            ->where('course', 'like', $program . '/%');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('course', 'like', "%$search%");
        }

        $courses = $query->distinct('course')->pluck('course');

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $courses = $sort === 'asc' ? $courses->sort() : $courses->sortDesc();
        }

        return view('Consultation.CtProgramHistory', compact('program', 'courses'));
    }

    public function showCourseHistory(Request $request, $program, $course)
    {
        $query = Appointment::where('consultant_role', Auth::id())
            ->where('course', 'like', $program . '/' . $course . '%');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('course', 'like', "%$search%")
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

        $appointments = $query->paginate(10)->appends($request->query());

        return view('Consultation.CtCourseHistory', compact('program', 'course', 'appointments'));
    }
}

