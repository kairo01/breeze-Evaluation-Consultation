<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Charmie Lynn Seno',
                'student_id' => null,
                'email' => 'HumanResources@example.com',
                'password' => Hash::make('password123'),
                'role' => 'HumanResources',
                'student_type' => null,
                'section' => null,
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Doreliza Pearl De Guzman',
                'student_id' => null,
                'email' => 'superadmin@example.com',
                'password' => Hash::make('superadminpassword'),
                'role' => 'SuperAdmin',
                'student_type' => null,
                'section' => null,
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jessica Gutierrez',
                'student_id' => null,
                'email' => 'Guidance@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Guidance',
                'student_type' => null,
                'section' => null,
                'status' => 'active',
                'remember_token' => null,
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
                'section' => 'Grade 7',
                'status' => 'active',
                'remember_token' => null,
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
                'section' => 'BSIT 101',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rostelyn Jane Abundia',
                'student_id' => '21-0040',
                'email' => 'Abundia@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David John De Leon',
                'student_id' => '21-0084', 
                'email' => 'Deleon@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Aldrin Portugal',
                'student_id' => '21-0044', 
                'email' => 'Portugal@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carl Angelo Maniangap',
                'student_id' => '21-0009', 
                'email' => 'Maniangap@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daniel Teddy Llanda',
                'student_id' => '21-0014', 
                'email' => 'Llanda@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [  
                'name' => 'Gwen',
                'student_id' => '21-0046', 
                'email' => 'Salut@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juanito Bugay',
                'student_id' => '18-0242', 
                'email' => 'Bugay@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Reyel Vargas',
                'student_id' => '21-0063',
                'email' => 'Vargas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chris Pangilinan',
                'student_id' => '21-0037',
                'email' => 'Pangilinan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Alfer Mendoza',
                'student_id' => '21-0089',
                'email' => 'Mendoza@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Allysa Denise Opemaria',
                'student_id' => '21-0042',
                'email' => 'Opemaria@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 401',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dhanrey Leal',
                'student_id' => '24-0315',
                'email' => 'Leal@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 403',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Darrel Jhon Barilla',
                'student_id' => '24-0234',
                'email' => 'Barilla@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 403',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rose Santillan',
                'student_id' => '24-0235',
                'email' => 'Santillan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 403',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nicole Espulgar',
                'student_id' => '23-0162',
                'email' => 'Espulgar@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'CS 201',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Raven Margareth Saltorre',
                'student_id' => '23-0069',
                'email' => 'Saltorre@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'CS 201',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aaron Tolentino',
                'student_id' => '24-0316',
                'email' => 'Tolentino@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 403',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jayvanz Singca',
                'student_id' => '23-0507',
                'email' => 'Singca@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Denmart Mariano',
                'student_id' => '23-0597',
                'email' => 'Mariano@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Scean Dulantre',
                'student_id' => '23-0434',
                'email' => 'Dulantre@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Neri Magpoc',
                'student_id' => '23-0505',
                'email' => 'Magpoc@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carl Tormes',
                'student_id' => '23-0509',
                'email' => 'Tormes@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khies Zuniga',
                'student_id' => '23-0566',
                'email' => 'Zuniga@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shekirah Sto.Domingo',
                'student_id' => '22-0231',
                'email' => 'Sto.Domingo@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charicel Vergara',
                'student_id' => '23-0550',
                'email' => 'Vergara@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lawrence Balasabas',
                'student_id' => '23-0292',
                'email' => 'Balasabas@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSIT 203',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jonas Aragon',
                'student_id' => '22-0240',
                'email' => 'Aragon@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Student',
                'student_type' => 'college',
                'section' => 'BSHM 304',
                'status' => 'active',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
