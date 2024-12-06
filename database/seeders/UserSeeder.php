<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'HumanResources',
                'email' => 'HumanResources@example.com',
                'password' => bcrypt('password123'),
                'role' => 'HumanResources', // Valid ENUM value
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guidance',
                'email' => 'Guidance@example.com',
                'password' => bcrypt('password123'),
                'role' => 'Guidance', // Valid ENUM value
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ComputerDepartment',
                'email' => 'ComputerDepartment@example.com',
                'password' => bcrypt('password123'),
                'role' => 'ComputerDepartment', // Valid ENUM value
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student',
                'email' => 'Student@example.com',
                'password' => bcrypt('password123'),
                'role' => 'Student', // Valid ENUM value
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}