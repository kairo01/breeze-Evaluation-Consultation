<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('Superadmin.SuperAdminDashboard'); // Replace with your actual view
    }
}
