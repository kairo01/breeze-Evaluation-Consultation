<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Notifications\AppointmentReminder;
use Carbon\Carbon;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders';
    protected $description = 'Send reminders for upcoming appointments';

    public function handle()
    {
        $oneHourFromNow = Carbon::now()->addHour();
        $twoHoursFromNow = Carbon::now()->addHours(2);

        $appointments = Appointment::where('status', 'Approved')
            ->whereBetween('date', [$oneHourFromNow, $twoHoursFromNow])
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->student->notify(new AppointmentReminder($appointment));
            $appointment->consultant->notify(new AppointmentReminder($appointment));
            $this->info("Reminder sent for appointment ID: {$appointment->id}");
        }

        $this->info('Appointment reminders sent successfully.');
    }
}

