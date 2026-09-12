<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin.jolo', 'full_name' => 'Jolo Miguel Ambrad', 'role' => 'Administrator'],
            ['username' => 'cashier.ana', 'full_name' => 'Ana Dela Cruz', 'role' => 'Cashier'],
            ['username' => 'cashier.ben', 'full_name' => 'Ben Torres', 'role' => 'Cashier'],
            ['username' => 'inventory.cara', 'full_name' => 'Cara Lim', 'role' => 'Inventory Clerk'],
            ['username' => 'manager.dino', 'full_name' => 'Dino Ramos', 'role' => 'Store Manager'],
        ];

        return view('users/index', [
            'title' => 'User Accounts',
            'page' => 'users',
            'users' => $users,
        ]);
    }
}
