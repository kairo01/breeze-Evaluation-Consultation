<?php

namespace App\Http\Controllers\AdminDepartmentHead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDpController extends Controller
{
    public function index()
    
    {
        return view('departmenthead.dpdashboard');
    }
}
