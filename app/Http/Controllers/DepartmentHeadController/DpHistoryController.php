<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DpHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::where('consultant_role', Auth::id());

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($q) use ($search) {
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

        $appointments = $query->paginate(10)->appends($request->query());

        return view('DepartmentHead.DpHistory', compact('appointments'));
    }

    public function getAppointmentDetails($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json([
            'status' => $appointment->is_completed == 1 ? 'Completed' : ($appointment->not_completed == 1 ? 'Not Completed' : $appointment->status),
            'rating' => $appointment->rating,
            'comment' => $appointment->comment,
        ]);
    }
}

