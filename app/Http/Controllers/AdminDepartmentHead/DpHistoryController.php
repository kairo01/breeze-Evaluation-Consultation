<?php

namespace App\Http\Controllers\AdminDepartmentHead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class DpHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', '!=', 'Pending')->get();
        return view('DepartmentHead.DpHistory', compact('appointments'));
    }
}
