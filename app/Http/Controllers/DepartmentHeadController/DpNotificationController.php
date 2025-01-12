<?php

namespace App\Http\Controllers\DepartmentHeadController;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;

class DpNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('DepartmentHead.DpNotification', compact('notifications'));
    }

}

