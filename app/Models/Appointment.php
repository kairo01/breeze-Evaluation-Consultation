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

    /**
     * The student who made the appointment.
     */
    public function student()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The consultant handling the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function consultant()
    {
        // Assuming 'consultant_role' links to a user in the 'users' table.
        return $this->belongsTo(User::class, 'consultant_role');
    }
}

