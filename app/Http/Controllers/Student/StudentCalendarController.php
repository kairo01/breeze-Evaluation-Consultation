<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusySlot;
use Illuminate\Http\Request;

class StudentCalendarController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('student_id', auth()->id())
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
}

