<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStudentType
{
    public function handle(Request $request, Closure $next, $studentType)
    {
        if (Auth::user()->role == 'Student' && Auth::user()->student_type == $studentType) {
            return $next($request);
        }

        // If the user doesn't match the expected student type, redirect them
        return redirect('/'); // Or some other page
    }
}
