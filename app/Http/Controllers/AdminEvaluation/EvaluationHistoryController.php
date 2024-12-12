<?php

namespace App\Http\Controllers\AdminEvaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluationHistoryController extends Controller
{
    public function show($department)
    {
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
        ];

        return view('Evaluation.EvaluationHistory');

        // Check if department exists
        if (!isset($departments[$department])) {
            abort(404); // Department not found

        }

        return view('Evaluation.EvaluationHistory', [
            'department' => $departments[$department],
        ]);
    }
}
