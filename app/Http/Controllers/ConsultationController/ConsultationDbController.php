<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultationDbController extends Controller
{
    public function index()
    
    {
        return view('Consultation.Ctdashboard');
    }
}
