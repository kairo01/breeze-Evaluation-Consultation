<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['student_id' , 'teacher_name', 'subject', 'teaching_skills', 'facilities'];

    protected $casts = [
        'student_id' => 'required' ,
        'teaching_skills' => 'array',
        'facilities' => 'array',
    ];
}
