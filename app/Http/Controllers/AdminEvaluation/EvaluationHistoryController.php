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
                    'image' => 'images/department_heads/computer_head.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Percian Joseph Borja',
                        'image' => 'images/faculty/computer/percian.jpg',
                    ],
                    [
                        'name' => 'Eric Almoguerra',
                        'image' => 'images/faculty/computer/eric.jpg',
                    ],
                    [
                        'name' => 'Aries Cayabyab',
                        'image' => 'images/faculty/computer/aries.jpg',
                    ],
                    [
                        'name' => 'Nomer Aleviado',
                        'image' => 'images/faculty/computer/nomer.jpg',
                    ],
                    [
                        'name' => 'Joseph Chua',
                        'image' => 'images/faculty/computer/joseph.jpg',
                    ],
                ],
            ],
            'hm' => [
                'name' => 'HM Department',
                'head' => [
                    'name' => 'Jessalyn Sarmiento Tancio',
                    'image' => 'images/department_heads/hm_head.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Katherine Araos',
                        'image' => 'images/faculty/hm/juan.jpg',
                    ],
                    [
                        'name' => 'Hannie Faye Cuaresma',
                        'image' => 'images/faculty/hm/ana.jpg',
                    ],
                    [
                        'name' => 'Jaevend Mae Deuda',
                        'image' => 'images/faculty/hm/carlos.jpg',
                    ],
                    [
                        'name' => 'Chrislyn Colleen Sison',
                        'image' => 'images/faculty/hm/diana.jpg',
                    ],
                    [
                        'name' => 'Atty. RK. Dela Fuente',
                        'image' => 'images/faculty/hm/luis.jpg',
                    ],
                ],
            ],
           'engineering' => [
                'name' => 'Engineering Department',
                'head' => [
                    'name' => 'Engr. Mark Villar',
                    'image' => 'images/department_heads/engineering_head.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Jane Dela Cruz',
                        'image' => 'images/faculty/engineering/jane.jpg',
                    ],
                    [
                        'name' => 'Paul Mendoza',
                        'image' => 'images/faculty/engineering/paul.jpg',
                    ],
                    [
                        'name' => 'Albert Ramos',
                        'image' => 'images/faculty/engineering/albert.jpg',
                    ],
                    [
                        'name' => 'Sarah Lim',
                        'image' => 'images/faculty/engineering/sarah.jpg',
                    ],
                    [
                        'name' => 'Francis Santos',
                        'image' => 'images/faculty/engineering/francis.jpg',
                    ],
                ],
            ],
            'tesda' => [
                'name' => 'Tesda Department',
                'head' => [
                    'name' => 'Pedro Garcia',
                    'image' => 'images/department_heads/tesda_head.jpg',
                ],
                'faculty' => [
                    [
                        'name' => 'Marissa Gomez',
                        'image' => 'images/faculty/tesda/marissa.jpg',
                    ],
                    [
                        'name' => 'Fernando Diaz',
                        'image' => 'images/faculty/tesda/fernando.jpg',
                    ],
                    [
                        'name' => 'Tessa Miranda',
                        'image' => 'images/faculty/tesda/tessa.jpg',
                    ],
                    [
                        'name' => 'Lorenzo Bautista',
                        'image' => 'images/faculty/tesda/lorenzo.jpg',
                    ],
                    [
                        'name' => 'Patricia Vega',
                        'image' => 'images/faculty/tesda/patricia.jpg',
                    ],
                ],
            ],
        ];

        // Check if department exists
        if (!isset($departments[$department])) {
            abort(404); // Department not found
        }

        return view('Evaluation.EvaluationHistory', [
            'department' => $departments[$department],
        ]);
    }
}
