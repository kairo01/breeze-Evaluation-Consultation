<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Show the Computer Department Dashboard
    public function index()
    {
        return view('computer-department.dashboard'); // Adjust the view path accordingly
    }

    // Add other methods as needed, e.g. for approval, history, etc.
}
