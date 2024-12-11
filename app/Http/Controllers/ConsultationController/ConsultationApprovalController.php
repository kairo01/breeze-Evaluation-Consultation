<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class ConsultationApprovalController extends Controller
{
    public function index()
    {
        // Fetch appointments pending approval by the Admin Consultant
        $appointments = Appointment::where('status', 'Pending')
            ->where('consultant', 'Admin Consultant') // Ensure this is for Admin Consultant approvals
            ->get();
        
        return view('Consultation.CtApproval', compact('appointments'));
    }

    public function store(Request $request)
    {
        // Find the appointment to approve or decline
        $appointment = Appointment::find($request->id);

        // If declined, add reason and set status to declined
        if ($request->status == 'Declined' && $request->reason) {
            $appointment->status = 'Declined';
            $appointment->decline_reason = $request->reason;
        } else {
            // Otherwise, set status to accepted
            $appointment->status = 'Accepted';
        }

        $appointment->save();

        // Redirect back with success message
        return redirect()->route('Consultation.CtApproval')->with('status', 'Appointment status updated!');
    }
}
