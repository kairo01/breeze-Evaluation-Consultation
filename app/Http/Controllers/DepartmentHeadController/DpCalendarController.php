<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DpCalendarController extends Controller
{
    public function index()
    {
        // Fetch all approved appointments for the department head
        $appointments = Appointment::where('consultant_role', auth()->id())
            ->where('status', 'Approved')
            ->get()
            ->map(function ($appointment) {
                return $appointment->getEventData();
            });

        return view('DepartmentHead.DpCalendar', compact('appointments'));
    }
}
