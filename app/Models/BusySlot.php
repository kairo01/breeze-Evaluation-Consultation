<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusySlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'from',
        'to',
        'busy_all_day',
        'consultant_role',
        'consultant_id',
    ];

    protected $casts = [
        'date' => 'date',
        'busy_all_day' => 'boolean',
    ];

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }
}

