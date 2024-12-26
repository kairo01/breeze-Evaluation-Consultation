<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class ConsultationHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('consultant_role', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('Consultation.CtHistory', compact('appointments'));
    }
}

