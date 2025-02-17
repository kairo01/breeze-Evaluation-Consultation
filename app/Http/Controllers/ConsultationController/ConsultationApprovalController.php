<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Notifications\AppointmentStatusNotification;

class ConsultationApprovalController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('consultant_role', auth()->id())
            ->where('status', 'Pending')
            ->paginate(10);
        return view('Consultation.CtApproval', compact('appointments'));
    }

    public function approve(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'approval_reason' => 'required|string|max:255',
        ]);

        $appointment = Appointment::findOrFail($validated['appointment_id']);
        $appointment->update([
            'status' => 'Approved',
            'approval_reason' => $validated['approval_reason'],
        ]);
    
        // Send notification to the student
        $appointment->student->notify(new AppointmentStatusNotification($appointment, 'approved'));
    
        return back()->with('success', 'Appointment approved successfully.');
    }

    public function decline(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);

        $validated = $request->validate([
            'decline_reason' => 'required|string|max:255',
        ]);

        $appointment->update([
            'status' => 'Declined',
            'decline_reason' => $validated['decline_reason'],
        ]);

        // Send notification to the student
        $appointment->student->notify(new AppointmentStatusNotification($appointment, 'declined'));

        return back()->with('success', 'Appointment declined successfully.');
    }
}

