<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentReminder extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $startTime = Carbon::parse($this->appointment->date->format('Y-m-d') . ' ' . $this->appointment->time->format('H:i:s'));
        
        return [
            'message' => 'Reminder: You have an appointment in 1 hour',
            'appointment_id' => $this->appointment->id,
            'start_time' => $startTime->format('Y-m-d H:i:s'),
            'with' => $notifiable->id === $this->appointment->student_id 
                ? $this->appointment->consultant->name 
                : $this->appointment->student->name,
            'purpose' => $this->appointment->purpose,
            'meeting_mode' => $this->appointment->meeting_mode,
            'meeting_preference' => $this->appointment->meeting_preference,
        ];
    }
}

