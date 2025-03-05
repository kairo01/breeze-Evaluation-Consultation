<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        'is_completed',
        'not_completed',
        'rating',
        'comment',
        'is_rescheduled',
        'original_appointment_id',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'is_completed' => 'integer',
        'not_completed' => 'integer',
        'is_rescheduled' => 'boolean',
    ];

    // Override the save method to add logging
    public function save(array $options = [])
    {
        // Log before saving
        Log::info('Saving appointment:', [
            'id' => $this->id,
            'is_completed' => $this->is_completed,
            'not_completed' => $this->not_completed
        ]);
        
        $result = parent::save($options);
        
        // Log after saving
        Log::info('After saving appointment:', [
            'id' => $this->id,
            'is_completed' => $this->is_completed,
            'not_completed' => $this->not_completed,
            'result' => $result
        ]);
        
        return $result;
    }

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

    public function isPastDue()
    {
        // If the appointment is already marked as completed or not completed, it's considered past due
        if ($this->is_completed == 1 || $this->not_completed == 1) {
            return true;
        }
        
        // Check if the appointment time has passed
        $appointmentEndTime = Carbon::parse($this->date->format('Y-m-d') . ' ' . $this->time->format('H:i:s'))->addHour();
        return now()->isAfter($appointmentEndTime);
    }

    public function getIsPastDueAttribute()
    {
        return $this->isPastDue();
    }

    public function originalAppointment()
    {
        return $this->belongsTo(Appointment::class, 'original_appointment_id');
    }

    public function rescheduledAppointment()
    {
        return $this->hasOne(Appointment::class, 'original_appointment_id');
    }

    public function canReschedule()
    {
        $twoWeeksFromNow = Carbon::now()->addWeeks(2)->endOfWeek();
        return $this->date->lte($twoWeeksFromNow);
    }

    public function canMakeNewAppointment()
    {
        $nextWeekStart = Carbon::now()->addWeek()->startOfWeek();
        return $this->is_completed == 1 && $this->date->lt($nextWeekStart);
    }
}

