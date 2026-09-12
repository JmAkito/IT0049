<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            ['full_name' => 'Angela Cruz', 'email' => 'angela.cruz@example.com', 'phone' => '0917 123 4501'],
            ['full_name' => 'Marco Reyes', 'email' => 'marco.reyes@example.com', 'phone' => '0918 234 5602'],
            ['full_name' => 'Bianca Santos', 'email' => 'bianca.santos@example.com', 'phone' => '0919 345 6703'],
            ['full_name' => 'Paolo Garcia', 'email' => 'paolo.garcia@example.com', 'phone' => '0920 456 7804'],
            ['full_name' => 'Sofia Mendoza', 'email' => 'sofia.mendoza@example.com', 'phone' => '0921 567 8905'],
        ];

        return view('customers/index', [
            'title' => 'Customer Accounts',
            'page' => 'customers',
            'customers' => $customers,
        ]);
    }
}
