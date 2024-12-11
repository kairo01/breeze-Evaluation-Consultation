<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DpCalendarController extends Controller
{
    public function index()
    
    {
        return view('DepartmentHead.DpCalendar');
    }
}
