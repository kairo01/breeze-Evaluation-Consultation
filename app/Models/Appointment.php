<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'date',
        'time',
        'status',
        'decline_reason',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_role');
    }

    public function getFormattedDateTimeAttribute()
    {
        return Carbon::parse($this->date->format('Y-m-d') . ' ' . $this->time->format('H:i:s'))->format('M d, Y h:i A');
    }

    public function getEventData()
    {
        return [
            'id' => $this->id,
            'title' => $this->student->name . ' - ' . $this->purpose,
            'start' => $this->date->format('Y-m-d') . 'T' . $this->time->format('H:i'),
            'end' => $this->date->format('Y-m-d') . 'T' . $this->time->addHour()->format('H:i'),
            'description' => 'Consultant: ' . $this->consultant->name . ' - ' . $this->course,
            'color' => '#1E90FF',
        ];
    }
}

