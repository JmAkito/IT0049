<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class PosSampleSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['full_name' => 'Ana Reyes', 'email' => 'ana@example.com', 'phone' => '09171234567'],
            ['full_name' => 'Marco Santos', 'email' => 'marco@example.com', 'phone' => '09181234567'],
            ['full_name' => 'Leah Cruz', 'email' => 'leah@example.com', 'phone' => '09191234567'],
            ['full_name' => 'Daniel Garcia', 'email' => 'daniel@example.com', 'phone' => '09201234567'],
            ['full_name' => 'Mia Flores', 'email' => 'mia@example.com', 'phone' => '09211234567'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        $users = [
            ['username' => 'admin', 'full_name' => 'Alex Rivera'],
            ['username' => 'jamie.lim', 'full_name' => 'Jamie Lim'],
            ['username' => 'sam.delacruz', 'full_name' => 'Sam Dela Cruz'],
            ['username' => 'taylor.m', 'full_name' => 'Taylor Mendoza'],
            ['username' => 'jordan.a', 'full_name' => 'Jordan Aquino'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}