<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class DpController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalAppointments = Appointment::where('consultant_role', $user->id)->count();
        $approvedAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Approved')->count();
        $pendingAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Pending')->count();
        $declinedAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Declined')->count();

        return view('DepartmentHead.DpDashboard', compact('totalAppointments', 'approvedAppointments', 'pendingAppointments', 'declinedAppointments'));
    }
}

