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
                    return redirect()->route('Consultation.CtDashboard');
                } elseif ($role === 'ComputerDepartment') {
                    return redirect()->route('DepartmentHead.DpDashboard');
                } elseif ($role === 'HumanResources') {
                    return redirect()->route('Adminevaluation.HrDashboard');
                } elseif ($role === 'Student') {
                    return redirect()->route('Student.StudentDashboard');
                }
                
                

                // Default redirect
              // RedirectIfAuthenticated middleware
return redirect('/new-route'); // Update to the new default route

            }
        }

        return $next($request);
    }
}
