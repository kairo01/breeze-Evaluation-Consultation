<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDepartmentType
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/'); // Redirect if not logged in
        }

        $role = Auth::user()->role; // Get the role here
        $allowedRoles = ['ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 'TesdaDepartment', 'HmDepartment'];

        if (in_array($role, $allowedRoles) || strpos($role, 'CustomDepartment:') === 0) {
            return $next($request);
        }

        // If the user is not a department head, redirect to home
        return redirect('/');
    }
}

