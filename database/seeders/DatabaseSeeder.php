<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Secondary Admin Account (Lea)
        User::updateOrCreate(
            ['email' => 'lea@gmail.com'],
            [
                'name' => 'Lea',
                'password' => Hash::make('HAHA123'),
                'role' => 'admin',
            ]
        );
    }
}