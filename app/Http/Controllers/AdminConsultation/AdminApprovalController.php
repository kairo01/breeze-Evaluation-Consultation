<?php

namespace App\Http\Controllers\AdminConsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminApprovalController extends Controller
{
    public function index()
    
    {
        return view('Consultation.CtApproval');
    }
}
