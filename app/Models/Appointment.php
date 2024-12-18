<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'consultant_role',
        'course',
        'purpose',
        'meeting_mode',
        'meeting_preference',
        'date_time',
        'status',
        'decline_reason',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_role');
    }

    public function getEventData()
    {
        return [
            'id' => $this->id,
            'title' => $this->student->name . ' - ' . $this->purpose,
            'start' => $this->date_time,
            'end' => $this->date_time,
            'description' => 'Consultant: ' . $this->consultant->name . ' - ' . $this->course,
            'color' => '#1E90FF', // Optional: Color for appointments
        ];
    }
}
