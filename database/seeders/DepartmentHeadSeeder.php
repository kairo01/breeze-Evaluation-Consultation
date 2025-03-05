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
            'name' => 'Jairryl Anne De Guzman',
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
            'name' => 'Engr. Adelino Cordova Jr.',
            'student_id' => null,
            'email' => 'EngineeringDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'EngineeringDeparment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create the department head for Math Department
        User::create([
            'name' => 'Arlene Cabillan',
            'student_id' => null,
            'email' => 'HighSchoolDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'HighSchoolDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create the department head for English Department
        User::create([
            'name' => 'Niño Corpuz',
            'student_id' => null,
            'email' => 'TesdaDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'TesdaDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Create the department head for English Department
        User::create([
            'name' => 'Jessalyn Sarmiento Tancio',
            'student_id' => null,
            'email' => 'HmDepartment@example.com',
            'password' => Hash::make('password123'),
            'role' => 'HmDepartment',
            'student_type' => null,
            'status' => 'active',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
