<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class DpApprovalController extends Controller
{
    public function index()
    {
        // Fetch appointments pending approval by the Department Head
        $appointments = Appointment::where('status', 'Pending')
            ->where('consultant', 'Department Head')  // Ensure this is for Department Head approvals
            ->get();
        
        return view('DepartmentHead.DpApproval', compact('appointments'));
    }

    public function store(Request $request)
    {
        // Find the appointment to approve or decline
        $appointment = Appointment::find($request->id);

        if ($request->status == 'Declined' && $request->reason) {
            $appointment->status = 'Declined';
            $appointment->decline_reason = $request->reason;
        } else {
            $appointment->status = 'Accepted';
        }

        $appointment->save();

        // Redirect back with success message
        return redirect()->route('DepartmentHead.DpApproval')->with('status', 'Appointment status updated!');
    }
}
