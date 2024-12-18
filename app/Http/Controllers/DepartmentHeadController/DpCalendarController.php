<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusySlot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DpCalendarController extends Controller
{
    public function index()
{
    // Fetch all approved appointments
    $appointments = Appointment::where('consultant_role', auth()->id())
        ->where('status', 'Approved')
        ->get()
        ->map(function ($appointment) {
            return array_merge($appointment->getEventData(), ['type' => 'appointment']);
        });

    // Fetch all busy slots
    $busySlots = BusySlot::where('consultant_role', auth()->user()->role)
        ->get()
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

    // Pass both appointments and busy slots to the view
    return view('DepartmentHead.DpCalendar', compact('appointments', 'busySlots'));
}



    public function storeBusySlot(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'from' => 'nullable|required_if:busyAllDay,false|date_format:H:i',
            'to' => 'nullable|required_if:busyAllDay,false|date_format:H:i',
        ]);

        $busyAllDay = $request->has('busyAllDay') && $request->busyAllDay == 'on';

        BusySlot::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'from' => $busyAllDay ? null : $validated['from'],
            'to' => $busyAllDay ? null : $validated['to'],
            'busy_all_day' => $busyAllDay,
            'consultant_role' => auth()->user()->role,
        ]);

        return redirect()->back()->with('success', 'Busy slot added successfully.');
    }
}
