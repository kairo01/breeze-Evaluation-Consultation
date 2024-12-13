<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DpApprovalController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('consultant_role', auth()->id())
            ->where('status', 'Pending')
            ->get();
        return view('DepartmentHead.DpApproval', compact('appointments'));
    }

    public function approve(Request $request)
    {
        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->update(['status' => 'Approved']);
        
        // Optionally notify the student here

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

        return back()->with('success', 'Appointment declined successfully.');
    }
}
