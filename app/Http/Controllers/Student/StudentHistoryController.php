<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\AppointmentCompletedNotification;
use App\Notifications\AppointmentNotCompletedNotification;
use Illuminate\Support\Facades\Log;

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

        $appointments = $query->paginate(10)->appends($request->query());
        
        // Debug log to check appointment values
        foreach ($appointments as $appointment) {
            Log::info('Appointment status check:', [
                'id' => $appointment->id,
                'is_completed' => $appointment->is_completed,
                'not_completed' => $appointment->not_completed,
                'is_rescheduled' => $appointment->is_rescheduled,
                'status' => $appointment->status
            ]);
        }

        return view('Student.StudentHistory', compact('appointments'));
    }

    public function markCompleted(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->student_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Debug log before checking completion status
        Log::info('Before marking as completed:', [
            'id' => $appointment->id,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed
        ]);

        // Check if the appointment is already completed or not completed
        if ($appointment->is_completed == 1 || $appointment->not_completed == 1) {
            return response()->json(['success' => false, 'message' => 'This appointment has already been marked as completed or not completed'], 400);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $appointment->is_completed = 1;
        $appointment->not_completed = 0;
        $appointment->rating = $validated['rating'];
        $appointment->comment = $validated['comment'];
        $result = $appointment->save();

        // Debug log after saving
        Log::info('After marking as completed:', [
            'id' => $appointment->id,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed,
            'save_result' => $result
        ]);

        // Reload from database to verify changes were saved
        $reloadedAppointment = Appointment::find($id);
        Log::info('Reloaded appointment after save:', [
            'id' => $reloadedAppointment->id,
            'is_completed' => $reloadedAppointment->is_completed,
            'not_completed' => $reloadedAppointment->not_completed
        ]);

        // Notify the consultant that the appointment has been marked as completed
        $appointment->consultant->notify(new AppointmentCompletedNotification($appointment));

        return response()->json(['success' => true, 'status' => 'Completed', 'canMakeNewAppointment' => $appointment->canMakeNewAppointment()]);
    }

    public function markNotCompleted($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->student_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Debug log before checking completion status
        Log::info('Before marking as not completed:', [
            'id' => $appointment->id,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed
        ]);

        // Check if the appointment is already completed or not completed
        if ($appointment->is_completed == 1 || $appointment->not_completed == 1) {
            return response()->json(['success' => false, 'message' => 'This appointment has already been marked as completed or not completed'], 400);
        }

        $appointment->not_completed = 1;
        $appointment->is_completed = 0;
        $appointment->is_rescheduled = false; // Ensure is_rescheduled is false when marking as not completed
        $result = $appointment->save();

        // Debug log after saving
        Log::info('After marking as not completed:', [
            'id' => $appointment->id,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed,
            'is_rescheduled' => $appointment->is_rescheduled,
            'save_result' => $result
        ]);

        // Reload from database to verify changes were saved
        $reloadedAppointment = Appointment::find($id);
        Log::info('Reloaded appointment after save:', [
            'id' => $reloadedAppointment->id,
            'is_completed' => $reloadedAppointment->is_completed,
            'not_completed' => $reloadedAppointment->not_completed,
            'is_rescheduled' => $reloadedAppointment->is_rescheduled
        ]);

        // Notify the consultant that the appointment has been marked as not completed
        $appointment->consultant->notify(new AppointmentNotCompletedNotification($appointment));

        return response()->json(['success' => true, 'status' => 'Not Completed']);
    }

    public function reschedule($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->student_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Mark the old appointment as not completed and rescheduled
        $appointment->not_completed = 1;
        $appointment->is_completed = 0;
        $appointment->is_rescheduled = true; // Set is_rescheduled to true when rescheduling
        $appointment->save();

        // Debug log after rescheduling
        Log::info('After marking as rescheduled:', [
            'id' => $appointment->id,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed,
            'is_rescheduled' => $appointment->is_rescheduled
        ]);

        // Redirect to the appointment form with pre-filled data
        return redirect()->route('Student.Consform.Appointment', [
            'reschedule' => true,
            'appointment_id' => $appointment->id,
            'consultant_id' => $appointment->consultant_role,
            'course' => $appointment->course,
            'purpose' => $appointment->purpose,
            'meeting_mode' => $appointment->meeting_mode,
            'meeting_preference' => $appointment->meeting_preference,
        ]);
    }

    public function getAppointmentDetails($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Debug log for appointment details
        Log::info('Getting appointment details:', [
            'id' => $appointment->id,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed,
            'is_rescheduled' => $appointment->is_rescheduled,
            'status' => $appointment->status
        ]);
        
        // Determine the correct status to display
        $displayStatus = $appointment->status;
        if ($appointment->is_completed == 1) {
            $displayStatus = 'Completed';
        } elseif ($appointment->not_completed == 1) {
            if ($appointment->is_rescheduled) {
                $displayStatus = 'Rescheduled';
            } else {
                $displayStatus = 'Not Completed';
            }
        }
        
        return response()->json([
            'status' => $displayStatus,
            'rating' => $appointment->rating,
            'comment' => $appointment->comment,
            'is_rescheduled' => $appointment->is_rescheduled,
            'is_completed' => $appointment->is_completed,
            'not_completed' => $appointment->not_completed,
        ]);
    }
}

