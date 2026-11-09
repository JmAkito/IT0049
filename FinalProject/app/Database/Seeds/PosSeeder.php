<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PosSeeder extends Seeder
{
    public function run()
    {
        // Avoid inserting the sample records again if the seeder is rerun.
        if ($this->db->table('users')->countAllResults() > 0) {
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('products')->insertBatch([
            [
                'name' => 'Notebook',
                'price' => 50.00,
                'stock_quantity' => 40,
                'image' => null,
                'created_at' => $now,
            ],
            [
                'name' => 'Ballpen',
                'price' => 15.00,
                'stock_quantity' => 100,
                'image' => null,
                'created_at' => $now,
            ],
            [
                'name' => 'Bond Paper',
                'price' => 2.00,
                'stock_quantity' => 500,
                'image' => null,
                'created_at' => $now,
            ],
            [
                'name' => 'Stapler',
                'price' => 120.00,
                'stock_quantity' => 15,
                'image' => null,
                'created_at' => $now,
            ],
            [
                'name' => 'Highlighter',
                'price' => 25.00,
                'stock_quantity' => 30,
                'image' => null,
                'created_at' => $now,
            ],
        ]);

        $this->db->table('customers')->insertBatch([
            [
                'full_name' => 'Ana Reyes',
                'email' => 'ana@example.com',
                'phone' => '09171234567',
                'created_at' => $now,
            ],
            [
                'full_name' => 'Marco Santos',
                'email' => 'marco@example.com',
                'phone' => '09181234567',
                'created_at' => $now,
            ],
            [
                'full_name' => 'Leah Cruz',
                'email' => 'leah@example.com',
                'phone' => '09191234567',
                'created_at' => $now,
            ],
        ]);

        $this->db->table('users')->insert([
            'username' => 'admin',
            'full_name' => 'Jolo Miguel Ambrad',
            'password' => password_hash('Admin123!', PASSWORD_DEFAULT),
            'avatar' => null,
            'created_at' => $now,
        ]);

        $notebook = $this->db->table('products')
            ->where('name', 'Notebook')
            ->get()
            ->getRowArray();

        $customer = $this->db->table('customers')
            ->where('email', 'ana@example.com')
            ->get()
            ->getRowArray();

        $user = $this->db->table('users')
            ->where('username', 'admin')
            ->get()
            ->getRowArray();

        $this->db->table('sales')->insert([
            'product_id' => $notebook['id'],
            'customer_id' => $customer['id'],
            'sold_by' => $user['id'],
            'quantity' => 2,
            'total_price' => 100.00,
            'created_at' => $now,
        ]);

        // The sample sale used 2 notebooks, so lower the displayed stock.
        $this->db->table('products')
            ->where('id', $notebook['id'])
            ->update(['stock_quantity' => 38]);
    }
}