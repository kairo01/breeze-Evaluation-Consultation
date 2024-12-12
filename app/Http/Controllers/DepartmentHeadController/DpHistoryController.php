<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DpHistoryController extends Controller
{
    /**
     * Display approved appointments.
     */
    public function index()
    {
        $appointments = Appointment::where('consultant_id', auth()->id())
            ->where('status', 'Approved')
            ->get();

        return view('DepartmentHead.DpHistory', compact('appointments'));
    }
}
