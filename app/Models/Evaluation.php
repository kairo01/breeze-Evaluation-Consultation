<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_name', 'subject', 'teaching_skills', 'facilities'];

    protected $casts = [
        'teaching_skills' => 'array',
        'facilities' => 'array',
    ];
}
