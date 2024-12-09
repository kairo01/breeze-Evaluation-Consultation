<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id', 'name', 'course', 'consultant', 'purpose', 'meeting_mode', 
        'meeting_preference', 'appointment_date_time', 'status',
    ];
}
