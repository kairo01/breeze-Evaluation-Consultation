<?php

namespace App\Http\Controllers\AdminConsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', '!=', 'Pending')->get();
        return view('Consultation.CtHistory', compact('appointments'));
    }
}
