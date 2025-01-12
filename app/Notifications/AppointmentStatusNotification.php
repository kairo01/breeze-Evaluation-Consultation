<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmentStatusNotification extends Notification
{
    use Queueable;

    protected $appointment;
    protected $status;

    public function __construct(Appointment $appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $message = 'Your appointment has been ' . $this->status;
        if ($this->status === 'approved') {
            $message .= ". Meeting details: " . $this->appointment->approval_reason;
            $message .= ". Date and Time: " . $this->appointment->formatted_date_time;
        } elseif ($this->status === 'declined') {
            $message .= ". Reason: " . $this->appointment->decline_reason;
        }
        return [
            'message' => $message,
            'appointment_id' => $this->appointment->id,
        ];
    }
}

