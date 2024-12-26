<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class ConsultationDbController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalAppointments = Appointment::where('consultant_role', $user->id)->count();
        $approvedAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Approved')->count();
        $pendingAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Pending')->count();
        $declinedAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Declined')->count();

        return view('Consultation.Ctdashboard', compact('totalAppointments', 'approvedAppointments', 'pendingAppointments', 'declinedAppointments'));
    }
    
}
