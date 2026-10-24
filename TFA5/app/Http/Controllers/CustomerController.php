<?php

namespace App\Http\Controllers;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            ['id' => 1, 'name' => 'Ana Reyes', 'email' => 'ana@example.com', 'phone' => '09171234567'],
            ['id' => 2, 'name' => 'Marco Santos', 'email' => 'marco@example.com', 'phone' => '09181234567'],
            ['id' => 3, 'name' => 'Leah Cruz', 'email' => 'leah@example.com', 'phone' => '09191234567'],
            ['id' => 4, 'name' => 'Daniel Garcia', 'email' => 'daniel@example.com', 'phone' => '09201234567'],
            ['id' => 5, 'name' => 'Mia Flores', 'email' => 'mia@example.com', 'phone' => '09211234567'],
        ];

        return view('customers', compact('customers'));
    }
}