<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Display the Super Admin dashboard.
     */
    public function index()
    {
        $totalAccounts = User::whereIn('role', [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment', 'HumanResources', 'Guidance'
        ])->count();
    
        return view('Superadmin.SuperAdminDashboard', compact('totalAccounts'));
    }

    /**
     * Display the list of accounts.
     */
    public function manageAccounts()
    {
        $accounts = User::whereIn('role', [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment', 'HumanResources', 'Guidance'
        ])->get();

        return view('Superadmin.manage', compact('accounts'));
    }

    /**
     * Show the form for creating a new account.
     */
    public function createAccount()
    {
        $roles = ['ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
                  'TesdaDepartment', 'HmDepartment', 'HumanResources', 'Guidance'];

        return view('Superadmin.create', compact('roles'));
    }

    /**
     * Store a newly created account.
     */
    public function storeAccount(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:ComputerDepartment,EngineeringDeparment,HighSchoolDepartment,TesdaDepartment,HmDepartment,HumanResources,Guidance', 
        ]);

        // Create the new user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Redirect back to the manage accounts page with a success message
        return redirect()->route('Superadmin.manage')->with('success', 'Account created successfully!');
    }

    /**
     * Show the form for editing an account role.
     */
    public function editAccount($role)
    {
        $account = User::where('role', $role)->firstOrFail();
        $roles = ['ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
                  'TesdaDepartment', 'HmDepartment', 'HumanResources', 'Guidance'];

        return view('Superadmin.edit', compact('account', 'roles'));
    }

    /**
     * Update an account role.
     */
    public function update(Request $request, $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'current_password' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);
    
        $account = User::where('role', $role)->firstOrFail();
    
        if (!Hash::check($request->current_password, $account->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    
        $account->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $request->filled('password') ? Hash::make($validated['password']) : $account->password,
        ]);
    
        return redirect()->route('Superadmin.manage')->with('success', 'User account updated successfully!');
    }

    /**
     * Delete an account.
     */
    public function deleteAccount($role)
    {
        $user = User::where('role', $role)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
