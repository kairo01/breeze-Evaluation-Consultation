<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;

class StudentCtNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('Student.StudentCtNotification', compact('notifications'));
    }

}

