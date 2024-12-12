<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class ConsultationHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', '!=', 'Pending')->get();
        return view('Consultation.CtHistory', compact('appointments'));
    }
}
