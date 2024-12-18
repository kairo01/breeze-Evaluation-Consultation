<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class EvaluationNotification extends Notification
{
    use Queueable;

    private $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database']; // Notification stored in DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->event->title,
            'description' => $this->event->description,
            'start_date' => $this->event->start_date,
            'student_type' => $notifiable->student_type, // Ensure student type is logged
        ];
    }
    
}
