<?php

namespace App\Http\Controllers\Student;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CollegeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalAppointments = Appointment::where('student_id', $user->id)->count();
        $approvedAppointments = Appointment::where('student_id', $user->id)->where('status', 'Approved')->count();
        $pendingAppointments = Appointment::where('student_id', $user->id)->where('status', 'Pending')->count();
        $declinedAppointments = Appointment::where('student_id', $user->id)->where('status', 'Declined')->count();

        $recentAppointments = Appointment::where('student_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->take(5)
            ->get();

        return view('Student.CollegeDashboard', compact('totalAppointments', 'approvedAppointments', 'pendingAppointments', 'declinedAppointments', 'recentAppointments'));
    }
}

