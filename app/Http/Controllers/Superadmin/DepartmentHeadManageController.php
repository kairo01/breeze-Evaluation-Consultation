<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DepartmentHeadManageController extends Controller
{
    public function index()
    {
        $departmentHeads = User::whereIn('role', [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment'
        ])->orWhere('role', 'like', 'CustomDepartment:%')->get();

        return view('Superadmin.DepartmentHeadManage', compact('departmentHeads'));
    }

    public function create()
    {
        $roles = [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment'
        ];

        return view('Superadmin.DepartmentHeadCreate', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:255',
        ]);

        $existingRoles = [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment', 'Guidance'
        ];

        $role = in_array($request->role, $existingRoles) ? $request->role : 'CustomDepartment:' . $request->role;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('superadmin.department-head.manage')->with('success', 'Department Head added successfully.');
    }

    public function edit($id)
    {
        $departmentHead = User::findOrFail($id);
        $roles = [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment'
        ];

        return view('Superadmin.DepartmentHeadEdit', compact('departmentHead', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|max:255',
        ]);

        $departmentHead = User::findOrFail($id);
        $departmentHead->name = $request->name;
        $departmentHead->email = $request->email;

        $existingRoles = [
            'ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 
            'TesdaDepartment', 'HmDepartment', 'Guidance'
        ];

        $role = in_array($request->role, $existingRoles) ? $request->role : 'CustomDepartment:' . $request->role;
        $departmentHead->role = $role;

        if ($request->filled('password')) {
            $departmentHead->password = Hash::make($request->password);
        }

        $departmentHead->save();

        return redirect()->route('superadmin.department-head.manage')->with('success', 'Department Head updated successfully.');
    }

    public function destroy($id)
    {
        $departmentHead = User::findOrFail($id);
        $departmentHead->delete();

        return redirect()->route('superadmin.department-head.manage')->with('success', 'Department Head deleted successfully.');
    }
}

