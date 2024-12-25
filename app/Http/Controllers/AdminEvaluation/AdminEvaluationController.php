<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class AdminEvaluationController extends Controller
{
    public function index()
    {
        // List of departments and faculty
        $departments = [
            'computer' => [
                'faculty' => [
                    'Percian Joseph Borja', 'Eric Almoguerra', 'Aries Cayabyab', 
                    'Nomer Aleviado', 'Joseph Chua'
                ],
            ],
            'hm' => [
                'faculty' => [
                    'Katherine Araos', 'Hannie Faye Cuaresma', 'Jaevend Mae Deuda', 
                    'Chrislyn Colleen Sison', 'Atty. RK. Dela Fuente'
                ],
            ],
            'engineering' => [
                'faculty' => [
                    'Jane Dela Cruz', 'Paul Mendoza', 'Albert Ramos', 
                    'Sarah Lim', 'Francis Santos'
                ],
            ],
            'tesda' => [
                'faculty' => [
                    'Marissa Gomez', 'Fernando Diaz', 'Tessa Miranda', 
                    'Lorenzo Bautista', 'Patricia Vega'
                ],
            ],
            'highschool' => [
                'faculty' => [
                    'Baby-Lyn Ravago', 'Ronald Simbul', 'Juniel Jenolan', 
                    'Dhan Ramos', 'Eljer Dizon', 'Angelica Garcia', 
                    'Shelby Enriquez', 'Mhaicka Tolentino', 'Mitzi Malixi', 
                    'Jan Antonnete Canindo', 'Christine Leron', 'Sean Reclosado', 'Saira Mangayao'
                ],
            ],
        ];

        // Count all teachers across all departments
        $totalTeachers = 0;
        foreach ($departments as $department) {
            $totalTeachers += count($department['faculty']);
        }

        // Count the unique students who have filled out the evaluation form
        $totalEvaluations = Evaluation::distinct('student_id')->count('student_id');

        // Pass the count to the view
        return view('Evaluation.HrDashboard', compact('totalEvaluations', 'totalTeachers'));
    }
}
