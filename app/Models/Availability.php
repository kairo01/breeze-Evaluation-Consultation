<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'days',
        'from_time',
        'to_time',
        'start_date',
        'end_date',
        'recurrence',
    ];

    protected $casts = [
        'days' => 'array',
        'from_time' => 'datetime',
        'to_time' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }
}

