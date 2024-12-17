<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DpHistoryController extends Controller
{
    public function index()
    {
        // Get the logged-in user’s role or ID
        $userId = Auth::id(); // Assuming the department head is logged in

        // Fetch appointments where the status is not 'Pending' and belong to the logged-in department head
        $appointments = Appointment::where('status', '!=', 'Pending')
            ->where('consultant_role', $userId) // Filter by department head’s ID
            ->get();

        return view('DepartmentHead.DpHistory', compact('appointments'));
    }
}
