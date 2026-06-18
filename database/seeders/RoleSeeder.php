<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'), // Default password
            'role' => 'admin',
        ]);

        // Create Teacher
        User::create([
            'username' => 'teacher',
            'password' => Hash::make('password'), // Default password
            'role' => 'teacher',
        ]);

    }
}
