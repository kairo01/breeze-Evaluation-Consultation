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
        'approval_reason',
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
        $start = $this->date->format('Y-m-d') . ' ' . $this->time->format('H:i:s');
        $end = $this->date->format('Y-m-d') . ' ' . $this->time->addHour()->format('H:i:s');
        return Carbon::parse($start)->format('M d, Y h:i A') . ' - ' . Carbon::parse($end)->format('h:i A');
    }

    public function getEventData()
    {
        $start = $this->date->format('Y-m-d') . 'T' . $this->time->format('H:i');
        $end = $this->date->format('Y-m-d') . 'T' . $this->time->addHour()->format('H:i');
        return [
            'id' => $this->id,
            'title' => $this->student->name . ' - ' . $this->purpose,
            'start' => $start,
            'end' => $end,
            'description' => 'Consultant: ' . $this->consultant->name . ' - ' . $this->course,
            'color' => '#1E90FF',
        ];
    }

    public function getIsCompletedAttribute()
    {
        return $this->status === 'Approved' && $this->date->addHour()->isPast();
    }

    public function getIsPastDueAttribute()
    {
        return $this->date->addHour()->isPast();
    }
}

