<?php

// app/Http/Middleware/CheckDepartmentType.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDepartmentType
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is a department head
        $allowedRoles = ['ComputerDepartment', 'ScienceDepartment', 'MathDepartment', 'EnglishDepartment'];

        if (in_array(Auth::user()->role, $allowedRoles)) {
            return $next($request);
        }

        // If the user is not a department head, redirect to home
        return redirect('/');
    }
}
