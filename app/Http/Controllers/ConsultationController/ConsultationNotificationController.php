<?php

namespace App\Http\Controllers\ConsultationController;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;

class ConsultationNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('Consultation.CtNotification', compact('notifications'));
    }
}

