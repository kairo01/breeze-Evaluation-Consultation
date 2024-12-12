<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DpApprovalController extends Controller
{
    /**
     * Display pending appointments for Department Head.
     */
    public function index()
    {
        $appointments = Appointment::where('consultant_id', auth()->id())
            ->where('status', 'Pending')
            ->get();

        return view('DepartmentHead.DpApproval', compact('appointments'));
    }

    /**
     * Approve an appointment.
     */
    public function approve(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);

        // Ensure the department head is authorized
        if ($appointment->consultant_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $appointment->update([
            'status' => 'Approved',
        ]);

        // Optionally, notify the student here

        return back()->with('success', 'Appointment approved successfully.');
    }

    /**
     * Decline an appointment.
     */
    public function decline(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);

        // Ensure the department head is authorized
        if ($appointment->consultant_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'decline_reason' => 'required|string|max:255',
        ]);

        $appointment->update([
            'status' => 'Declined',
            'decline_reason' => $validated['decline_reason'],
        ]);

        // Optionally, notify the student here

        return back()->with('success', 'Appointment declined successfully.');
    }
}
