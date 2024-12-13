<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ConsultationCalendarController extends Controller
{
    public function index()
    {
        // Fetch all the approved appointments for the consultant
        $appointments = Appointment::where('consultant_role', auth()->id())
            ->where('status', 'Approved')
            ->get()
            ->map(function ($appointment) {
                return $appointment->getEventData();
            });

        return view('Consultation.CtCalendar', compact('appointments'));
    }
}
