<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ConsultationApprovalController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('consultant_role', auth()->id())
            ->where('status', 'Pending')
            ->get();
        return view('Consultation.CtApproval', compact('appointments'));
    }

    public function approve(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->update(['status' => 'Approved']);
        
        // Notify the student or take other actions if necessary
        
        // Redirect to consultation calendar or back to approval page
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

        // Optionally, notify the student about the decline

        return back()->with('success', 'Appointment declined successfully.');
    }
}
