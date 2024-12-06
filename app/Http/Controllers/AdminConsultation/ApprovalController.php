<?php

namespace App\Http\Controllers\AdminConsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        // Return the view located in resources/views/AdminConsultation/CtApproval.blade.php
        return view('AdminConsultation.CtApproval');
    }
}
