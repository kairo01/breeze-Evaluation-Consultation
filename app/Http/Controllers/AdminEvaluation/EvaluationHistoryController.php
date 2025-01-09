<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationHistoryController extends Controller
{
    public function show($department)
    {
        // List of departments
        $departments = [
            'computer' => [
                'name' => 'Computer Department',
                'head' => [
                    'name' => 'Jhai De Guzman',
                    'image' => 'css/GeneralResources/collegelogo.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Percian Joseph Borja',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Eric Almoguerra',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Aries Cayabyab',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Nomer Aleviado',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Joseph Chua',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                ],
            ],
            'hm' => [
                'name' => 'HM Department',
                'head' => [
                    'name' => 'Jessalyn Sarmiento Tancio',
                    'image' => 'css/GeneralResources/Hm.jfif',
                ],
                'faculty' => [
                    [
                        'name' => 'Katherine Araos',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Hannie Faye Cuaresma',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Jaevend Mae Deuda',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Chrislyn Colleen Sison',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Atty. RK. Dela Fuente',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                ],
            ],
            'engineering' => [
                'name' => 'Engineering Department',
                'head' => [
                    'name' => 'Engr. Mark Villar',
                    'image' => 'css/GeneralResources/icon.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Jane Dela Cruz',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Paul Mendoza',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Albert Ramos',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Sarah Lim',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Francis Santos',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                ],
            ],
            'tesda' => [
                'name' => 'Tesda Department',
                'head' => [
                    'name' => 'Pedro Garcia',
                    'image' => 'css/GeneralResources/icon.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Marissa Gomez',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Fernando Diaz',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Tessa Miranda',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Lorenzo Bautista',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Patricia Vega',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                ],
            ],
            
            'highschool' => [
                'name' => 'High School Department',
                'head' => [
                    'name' => 'Arlene Cabillan',
                    'image' => 'css/GeneralResources/icon.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Baby-Lyn Ravago',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Ronald Simbul',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Juniel Jenolan',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Dhan Ramos',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Eljer Dizon',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Angelica Garcia',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Shelby Enriquez',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Mhaicka Tolentino',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Mitzi Malixi',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Jan Antonnete Canindo',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Christine Leron',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Sean Reclosado',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Saira Mangayao',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                ],
            ],

                 'gened' => [
                    'name' => 'Gen Ed Department',
                        'faculty' => [
                    [
                        'name' => 'Cabillan, Arlene',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'De Guzman, Doreliza Pearl',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Dizon, Eljer',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Jenolan, Juniel',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Ramos, Danilo',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Ravago, Baby-lyn',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Seno, Charmie Lynn',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Simbul, Ronald Jr.',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Razon, King Jovan',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Bautista, Marie-nel',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Enriquez, Maria Deth',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Layug, Romeo',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Zabala, Sheila',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Gomez, Rochelle',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Isuan, Shiena Marie',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Delos Reyes, Alexander John',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Clacio, Corazon',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Castillo, Jett Noelson',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Roman, Marijuane',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Maranan, Alexia',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Acosta, Allan',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                    [
                        'name' => 'Gomez, Mariz',
                        'image' => 'css/GeneralResources/icon.jpg',
                    ],
                ],
            ],     
        ];
    
        // Check if the requested department exists
        if (!isset($departments[$department])) {
            abort(404); // Department not found
        }

        $user = Auth::user();
        $user_email = $user->email;
        
        // // $users = User::where('email' , 'Humanresources@example.com');
        if ($user_email === "HumanResources@example.com") {
            return view('Evaluation.EvaluationHistory', [
                'department' => $departments[$department],
            ]);
            
        }else{
            return view('Student.evaluation.FacultyList', [
                'department' => $departments[$department],
            ]);
            
        }

       
    
        
    }

    public function index(Request $request) {

        $teacher_name = $request->query('teacher_name');

        $evaluations = Evaluation::where('teacher_name', $teacher_name)->get();

        return view('Evaluation.HrHistory',compact('evaluations', 'teacher_name'));
    }

    public function History() {
        

        return view('Evaluation.HrHistory' ,compact('evaluations'));
    }
    
    public function showEvaluationHistory()
{
    $evaluations = Evaluation::with(['facilities', 'teacher'])->get();  // Assuming relationships are set up
    
    return view('evaluation.history', compact('evaluations'));
}

}
