<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{ 
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'student_type',
        'student_id',
        'section',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function approvedAppointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function notifies()
    {
        return $this->hasMany(Notify::class);
    }

    public function hasRole($role)
    {
        Log::info('User::hasRole check', [
            'user_id' => $this->id,
            'user_role' => $this->role,
            'checked_role' => $role
        ]);

        return $this->role === $role;
    }
}

