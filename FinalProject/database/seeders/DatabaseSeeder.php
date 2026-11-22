<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $isProduction = app()->environment('production');
        $adminUsername = env('POS_ADMIN_USERNAME', $isProduction ? null : 'admin');
        $adminPassword = env('POS_ADMIN_PASSWORD', $isProduction ? null : 'Admin123!');

        if (! $adminUsername || ! $adminPassword) {
            throw new RuntimeException('Set POS_ADMIN_USERNAME and POS_ADMIN_PASSWORD before seeding a production database.');
        }

        User::updateOrCreate(['username' => $adminUsername], [
            'full_name' => env('POS_ADMIN_NAME', 'POS Administrator'),
            'password' => $adminPassword,
        ]);

        foreach ([
            ['full_name' => 'Ana Reyes', 'email' => 'ana@example.com', 'phone' => '09171234567'],
            ['full_name' => 'Marco Santos', 'email' => 'marco@example.com', 'phone' => '09181234567'],
            ['full_name' => 'Leah Cruz', 'email' => 'leah@example.com', 'phone' => null],
        ] as $customer) Customer::updateOrCreate(['email' => $customer['email']], $customer);

        foreach ([
            ['name' => 'Notebook', 'price' => 50, 'stock_quantity' => 38],
            ['name' => 'Ballpen', 'price' => 15, 'stock_quantity' => 100],
            ['name' => 'Bond Paper', 'price' => 2, 'stock_quantity' => 500],
            ['name' => 'Stapler', 'price' => 120, 'stock_quantity' => 15],
            ['name' => 'Highlighter', 'price' => 25, 'stock_quantity' => 30],
        ] as $product) Product::updateOrCreate(['name' => $product['name']], $product);
    }
}
