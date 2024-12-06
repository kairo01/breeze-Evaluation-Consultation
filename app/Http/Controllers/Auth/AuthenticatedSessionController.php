<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    // Custom redirection based on user role
    $role = Auth::user()->role; // Ensure your `users` table has a `role` column

    if ($role === 'Guidance') {
        return redirect()->route('Consultation.CtDashboard');
    } elseif ($role === 'ComputerDepartment') {
        return redirect()->route('departmenthead.dpdashboard');
    } elseif ($role === 'HumanResources') {
        return redirect()->route('HrDashboard');
    } elseif ($role === 'Student') {
        // Redirect based on student type (college or highschool)
        $studentType = Auth::user()->student_type;
        return redirect()->route('Student.StudentDashboardByType', ['student_type' => $studentType]);
    } else {
        return redirect()->route('dashboard'); 
    }

    // Default redirection if role does not match
    return redirect()->intended(RouteServiceProvider::HOME);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
