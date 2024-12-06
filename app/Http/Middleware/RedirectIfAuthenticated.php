<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role;

                // Redirect based on user role
                if ($role === 'Guidance') {
                    return redirect()->route('ctdashboard');
                } elseif ($role === 'ComputerDepartment') {
                    return redirect()->route('admindepartment.dpdashboard');
                } elseif ($role === 'HumanResources') {
                    return redirect()->route('adminevaluation.hrdashboard');
                } elseif ($role === 'student') {
                    return redirect()->route('student.studentdashboard');
                }
                
                

                // Default redirect
              // RedirectIfAuthenticated middleware
return redirect('/new-route'); // Update to the new default route

            }
        }

        return $next($request);
    }
}
