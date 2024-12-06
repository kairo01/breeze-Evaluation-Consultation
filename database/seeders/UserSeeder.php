<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'HumanResources',
                'email' => 'HumanResources@example.com',
                'password' => Hash::make('password123'),
                'role' => 'HumanResources',
                'student_type' => null,
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guidance',
                'email' => 'Guidance@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Guidance',
                'student_type' => null,
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ComputerDepartment',
                'email' => 'ComputerDepartment@example.com',
                'password' => Hash::make('password123'),
                'role' => 'ComputerDepartment',
                'student_type' => null,
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HighSchoolStudent',
                'email' => 'highschool@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'highschool',
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CollegeStudent',
                'email' => 'college@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
