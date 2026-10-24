<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => 'Alex Rivera', 'email' => 'alex@example.com', 'role' => 'Admin'],
            ['id' => 2, 'name' => 'Jamie Lim', 'email' => 'jamie@example.com', 'role' => 'Cashier'],
            ['id' => 3, 'name' => 'Sam Dela Cruz', 'email' => 'sam@example.com', 'role' => 'Manager'],
            ['id' => 4, 'name' => 'Taylor Mendoza', 'email' => 'taylor@example.com', 'role' => 'Cashier'],
            ['id' => 5, 'name' => 'Jordan Aquino', 'email' => 'jordan@example.com', 'role' => 'Admin'],
        ];

        return view('users', compact('users'));
    }
}