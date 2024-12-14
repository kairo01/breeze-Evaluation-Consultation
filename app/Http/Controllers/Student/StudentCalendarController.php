<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Appointment;
use App\Models\BusySlot;
use App\Http\Controllers\Controller;

class StudentCalendarController extends Controller
{
    public function index()
    {
        // Fetch approved appointments for the student
        $appointments = Appointment::where('student_id', auth()->id())
                                   ->where('status', 'Approved')
                                   ->get()
                                   ->map(function ($appointment) {
                                       return array_merge($appointment->getEventData(), ['type' => 'appointment']);
                                   });

        // Fetch busy slots for all consultants
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

        // Pass both to the view
        return view('Student.StudentCalendar', compact('appointments', 'busySlots'));
    }
}
