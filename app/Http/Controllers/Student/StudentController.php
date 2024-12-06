<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('Student.StudentDashboard');
    }

    public function studentDashboardByType($student_type)
    {
        // Check if the student type is valid
        if (!in_array($student_type, ['college', 'highschool'])) {
            abort(404);  // If invalid student type, show 404 error
        }

        // Load the dashboard for the specific student type (college or highschool)
        return view("Student.Student{$student_type}Dashboard");
    }
}
