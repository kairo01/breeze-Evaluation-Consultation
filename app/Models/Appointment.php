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
    public function index()
{
    // Retrieve appointments from the database (example)
    $appointments = Appointment::where('student_id', auth()->id())
        ->where('status', 'Approved') // Only include approved appointments
        ->get()
        ->map(function ($appointment) {
            return [
                'title' => $appointment->purpose,
                'start' => $appointment->date_time,
                'description' => 'Consultant: ' . $appointment->consultant->name,
            ];
        });

    // Pass the appointments to the Blade template
    return view('student.studentCalendar', compact('appointments'));
}
public function getEventData()
{
    return [
        'id' => $this->id,
        'title' => $this->student->name . ' - ' . $this->purpose,
        'start' => $this->date_time,
        'end' => $this->date_time,
        'description' => 'Consultant: ' . $this->consultant->name . ' - ' . $this->course,
    ];
}

}

