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
                'student_id' => null,
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
                'student_id' => null,
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
                'name' => 'HighSchoolStudent',
                'student_id' => '21-000',
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
                'student_id' => '21-001',
                'email' => 'college@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rostelyn',
                'student_id' => '21-0122',
                'email' => 'Rostelyn@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Jayvanz',
                'student_id' => '23-0507',
                'email' => 'Jayvanz@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,  // Add remember_token here
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'John Doe',
                'student_id' => '21-0123',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Alice Brown',
                'student_id' => '21-0124',
                'email' => 'alicebrown@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Mark Johnson',
                'student_id' => '21-0125',
                'email' => 'markjohnson@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'inactive',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Sophia White',
                'student_id' => '21-0126',
                'email' => 'sophiawhite@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
