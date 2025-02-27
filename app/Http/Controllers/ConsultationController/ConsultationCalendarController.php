<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusySlot;
use App\Models\Availability;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsultationCalendarController extends Controller
{
   public function index()
   {
       $appointments = Appointment::where('consultant_role', auth()->id())
           ->where('status', 'Approved')
           ->get()
           ->map(function ($appointment) {
               $start = Carbon::parse($appointment->date->format('Y-m-d') . ' ' . $appointment->time->format('H:i:s'));
               $end = $start->copy()->addHour();
               $now = Carbon::now();
               $isDone = $now->isAfter($end);
               $status = $isDone ? 'Done' : 'Ongoing';

               return [
                   'id' => $appointment->id,
                   'title' => $appointment->student->name,
                   'start' => $start->format('Y-m-d\TH:i:s'),
                   'end' => $end->format('Y-m-d\TH:i:s'),
                   'description' => $appointment->purpose,
                   'color' => $isDone ? '#4CAF50' : '#1E90FF', // Green if done, Blue if ongoing
                   'type' => 'appointment',
                   'status' => $status,
               ];
           });

       $busySlots = BusySlot::where('consultant_id', auth()->id())
           ->get()
           ->map(function ($slot) {
               $start = $slot->busy_all_day ? $slot->date->format('Y-m-d') : $slot->date->format('Y-m-d') . 'T' . $slot->from->format('H:i:s');
               $end = $slot->busy_all_day ? $slot->date->format('Y-m-d') : $slot->date->format('Y-m-d') . 'T' . $slot->to->format('H:i:s');
               return [
                   'id' => $slot->id,
                   'title' => 'Busy: ' . $slot->title,
                   'start' => $start,
                   'end' => $end,
                   'description' => $slot->description,
                   'color' => '#FF5733',
                   'type' => 'busy_slot',
                   'allDay' => $slot->busy_all_day,
               ];
           });

       $availabilities = Availability::where('consultant_id', auth()->id())
           ->get()
           ->flatMap(function ($availability) {
               $events = [];
               $start = Carbon::parse($availability->start_date);
               $end = Carbon::parse($availability->end_date);

               while ($start <= $end) {
                   if (in_array($start->format('l'), $availability->days)) {
                       $events[] = [
                           'id' => 'availability_' . $availability->id . '_' . $start->format('Y-m-d'),
                           'title' => 'Available',
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

       return view('Consultation.CtCalendar', compact('appointments', 'busySlots', 'availabilities'));
   }

   // ... (existing methods)

    public function storeBusySlot(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'from' => 'nullable|required_if:busyAllDay,false|date_format:H:i',
            'to' => 'nullable|required_if:busyAllDay,false|date_format:H:i|after:from',
        ]);

        $busyAllDay = $request->has('busyAllDay');

        $busySlot = new BusySlot([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'busy_all_day' => $busyAllDay,
            'consultant_role' => auth()->user()->role,
            'consultant_id' => auth()->id(),
        ]);

        if (!$busyAllDay) {
            $busySlot->from = Carbon::createFromFormat('Y-m-d H:i', $validated['date'] . ' ' . $validated['from']);
            $busySlot->to = Carbon::createFromFormat('Y-m-d H:i', $validated['date'] . ' ' . $validated['to']);
        }

        $busySlot->save();

        return redirect()->back()->with('success', 'Busy slot added successfully.');
    }

    public function deleteBusySlot($id)
    {
        try {
            $busySlot = BusySlot::findOrFail($id);
    
            if ($busySlot->consultant_id !== auth()->id()) {
                return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
            }

            $busySlot->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
        $totalAppointments = Appointment::where('consultant_role', $user->id)->count();
        $approvedAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Approved')->count();
        $pendingAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Pending')->count();
        $declinedAppointments = Appointment::where('consultant_role', $user->id)->where('status', 'Declined')->count();

        return view('Consultation.CtDashboard', compact('totalAppointments', 'approvedAppointments', 'pendingAppointments', 'declinedAppointments'));
    }

   public function storeAvailability(Request $request)
   {
       $validated = $request->validate([
           'days' => 'required|array',
           'from_time' => 'required|date_format:H:i',
           'to_time' => 'required|date_format:H:i|after:from_time',
           'recurrence' => 'required|in:week,month,year',
           'end_date' => 'required|date|after:today',
       ]);

       $availability = new Availability([
           'consultant_id' => auth()->id(),
           'days' => $validated['days'],
           'from_time' => $validated['from_time'],
           'to_time' => $validated['to_time'],
           'start_date' => now()->toDateString(),
           'end_date' => $validated['end_date'],
           'recurrence' => $validated['recurrence'],
       ]);

       $availability->save();

       return redirect()->back()->with('success', 'Availability created successfully.');
   }
}

