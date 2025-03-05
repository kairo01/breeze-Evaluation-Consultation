<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class ConsultationHistoryController extends Controller
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

        return view('Consultation.CtHistory', compact('appointments'));
    }

    public function getAppointmentDetails($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
        
            // Check if the appointment belongs to the current consultant
            if ($appointment->consultant_role != Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        
            return response()->json([
                'status' => $appointment->is_completed == 1 ? 'Completed' : ($appointment->not_completed == 1 ? 'Not Completed' : $appointment->status),
                'rating' => $appointment->rating,
                'comment' => $appointment->comment,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching appointment details: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch appointment details'], 500);
        }
    }
}

