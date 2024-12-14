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
    ];
}
