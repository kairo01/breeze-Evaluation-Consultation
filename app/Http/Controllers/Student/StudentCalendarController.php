<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusySlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCalendarController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('student_id', Auth::id())
            ->where('status', 'Approved')
            ->get()
            ->map(function ($appointment) {
                return array_merge($appointment->getEventData(), ['type' => 'appointment']);
            });

        $busySlots = BusySlot::all()
            ->map(function ($slot) {
                return [
                    'title' => $slot->title,
                    'start' => $slot->busy_all_day ? $slot->date : $slot->date . 'T' . $slot->from,
                    'end' => $slot->busy_all_day ? null : $slot->date . 'T' . $slot->to,
                    'description' => $slot->description,
                    'color' => '#FF5733',
                    'type' => 'busy_slot',
                ];
            });

        return view('Student.StudentCalendar', compact('appointments', 'busySlots'));
    }

    public function highSchoolDashboard()
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

        return view('Student.HighSchoolDashboard', compact('totalAppointments', 'approvedAppointments', 'pendingAppointments', 'declinedAppointments', 'recentAppointments'));
    }

    public function collegeDashboard()
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

