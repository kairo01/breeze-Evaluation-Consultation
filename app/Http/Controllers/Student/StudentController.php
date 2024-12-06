<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   
    public function collegeDashboard()
    {
        return view('Student.StudentCollegeDashboard'); // Adjusted to match the correct view path
    }

    // Dashboard for High School Students
    public function highschoolDashboard()
    {
        return view('Student.StudentHighschoolDashboard'); // Adjusted to match the correct view path
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
