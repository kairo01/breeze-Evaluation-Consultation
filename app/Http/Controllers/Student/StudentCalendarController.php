<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusySlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Availability;

class StudentCalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $appointments = Appointment::where('student_id', $user->id)
            ->where('status', 'Approved')
            ->get()
            ->map(function ($appointment) {
                $start = Carbon::parse($appointment->date->format('Y-m-d') . ' ' . $appointment->time->format('H:i:s'));
                $end = $start->copy()->addHour();
                $now = Carbon::now();
                $isDone = $now->isAfter($end);
                $status = $isDone ? 'Done' : 'Upcoming';

                return [
                    'id' => $appointment->id,
                    'title' => $appointment->purpose,
                    'start' => $start->format('Y-m-d\TH:i:s'),
                    'end' => $end->format('Y-m-d\TH:i:s'),
                    'description' => 'Consultant: ' . $appointment->consultant->name,
                    'color' => $isDone ? '#4CAF50' : '#1E90FF', // Green if done, Blue if upcoming
                    'type' => 'appointment',
                    'status' => $status,
                ];
            });

        $busySlots = BusySlot::when($user->student_type === 'HighSchool', function ($query) {
            return $query->where('consultant_role', 'HighSchoolDepartment');
        })
        ->when($user->student_type === 'College', function ($query) {
            return $query->whereIn('consultant_role', ['Guidance', 'ComputerDepartment', 'EngineeringDeparment', 'TesdaDepartment', 'HmDepartment']);
        })
        ->get()
        ->map(function ($slot) {
            $start = $slot->busy_all_day ? $slot->date->format('Y-m-d') : $slot->date->format('Y-m-d') . 'T' . $slot->from->format('H:i:s');
            $end = $slot->busy_all_day ? $slot->date->format('Y-m-d') : $slot->date->format('Y-m-d') . 'T' . $slot->to->format('H:i:s');
            return [
                'id' => $slot->id,
                'title' => $slot->title,
                'start' => $start,
                'end' => $end,
                'description' => $slot->description,
                'color' => '#FF5733',
                'type' => 'busy_slot',
                'consultant_name' => $slot->consultant->name,
                'consultant_role' => $slot->consultant_role,
                'allDay' => $slot->busy_all_day,
            ];
        });

        $user = Auth::user();
        $availabilities = Availability::whereHas('consultant', function ($query) use ($user) {
            if ($user->student_type === 'HighSchool') {
                $query->where('role', 'HighSchoolDepartment');
            } else {
                $query->whereIn('role', ['Guidance', 'ComputerDepartment', 'EngineeringDeparment', 'TesdaDepartment', 'HmDepartment']);
            }
        })
        ->get()
        ->flatMap(function ($availability) {
            $events = [];
            $start = Carbon::parse($availability->start_date);
            $end = Carbon::parse($availability->end_date);

            while ($start <= $end) {
                if (in_array($start->format('l'), $availability->days)) {
                    $events[] = [
                        'id' => 'availability_' . $availability->id . '_' . $start->format('Y-m-d'),
                        'title' => 'Consultant Available: ' . $availability->consultant->name,
                        'start' => $start->format('Y-m-d') . 'T' . $availability->from_time->format('H:i:s'),
                        'end' => $start->format('Y-m-d') . 'T' . $availability->to_time->format('H:i:s'),
                        'color' => '#28a745',
                        'type' => 'availability',
                    ];
                }
                $start->addDay();
            }

            return $events;
        });

        return view('Student.StudentCalendar', compact('appointments', 'busySlots', 'availabilities'));
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

