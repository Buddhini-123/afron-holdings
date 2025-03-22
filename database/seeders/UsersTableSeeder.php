<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the users data
        $users = [
            [
                'name' => 'Colombo',
                'email' => 'colombo@gmail.com',
                'password' => Hash::make('password'), // Default password for all users
            ],
            [
                'name' => 'Batticaloa',
                'email' => 'batticaloa@gmail.com',
                'password' => Hash::make('password'), // Default password for all users
            ],
            [
                'name' => 'Kilinochchi',
                'email' => 'kilinochchi@gmail.com',
                'password' => Hash::make('password'), // Default password for all users
            ],
            [
                'name' => 'Mannar',
                'email' => 'mannar@gmail.com',
                'password' => Hash::make('password'), // Default password for all users
            ],
        ];

        // Insert the users into the database
        DB::table('users')->insert($users);
    }
}
