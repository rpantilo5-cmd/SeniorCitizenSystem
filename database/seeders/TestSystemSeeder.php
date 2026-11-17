<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barangay;
use App\Models\Senior;
use App\Models\User;

class TestSystemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Maghimo og Test User (Barangay Social Worker)
        $user = User::create([
            'name' => 'Maria Social Worker',
            'email' => 'worker@barangay.gov.ph',
            'password' => bcrypt('password123'),
        ]);

        // 2. Maghimo og Test Barangay
        $barangay = Barangay::create([
            'name' => 'Barangay Poblacion 1',
        ]);

        // 3. Maghimo og Test Senior Citizen
        $senior = Senior::create([
            'osca_id_no' => 'OSCA-2026-001',
            'first_name' => 'Juan',
            'middle_name' => 'Dela',
            'last_name' => 'Cruz',
            'suffix' => 'Sr.',
            'birthdate' => '1955-06-15',
            'gender' => 'Male',
            'barangay_id' => $barangay->id,
            'address' => 'Purok 2, Main Street',
            'pension_status' => 'Social Pensioner',
            'status' => 'Active',
        ]);

        echo "\n SUCCESS! Puno na ang Database:\n";
        echo " - User: " . $user->name . "\n";
        echo " - Barangay: " . $barangay->name . "\n";
        echo " - Senior Registered: " . $senior->first_name . " " . $senior->last_name . " (OSCA ID: " . $senior->osca_id_no . ")\n\n";
    }
}