<?php

// database/seeders/DepartmentHeadSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DepartmentHeadSeeder extends Seeder
{
    public function run()
    {
        // Create the department head for Computer Department
        User::create([
            'name' => 'ComputerDepartment',
            'student_id' => null,
            'email' => 'ComputerDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'ComputerDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create the department head for Science Department
        User::create([
            'name' => 'ScienceDepartment',
            'student_id' => null,
            'email' => 'ScienceDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'ScienceDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create the department head for Math Department
        User::create([
            'name' => 'MathDepartment',
            'student_id' => null,
            'email' => 'MathDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'MathDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create the department head for English Department
        User::create([
            'name' => 'EnglishDepartment',
            'student_id' => null,
            'email' => 'EnglishDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'EnglishDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
