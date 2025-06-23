<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone_number' => '+1234567890',
                'password' => Hash::make('password123'),
                'wallet_balance' => 1000.00
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone_number' => '+1234567891',
                'password' => Hash::make('password123'),
                'wallet_balance' => 750.50
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'phone_number' => '+1234567892',
                'password' => Hash::make('password123'),
                'wallet_balance' => 500.25
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'phone_number' => '+1234567893',
                'password' => Hash::make('password123'),
                'wallet_balance' => 1250.75
            ],
            [
                'name' => 'Charlie Davis',
                'email' => 'charlie@example.com',
                'phone_number' => '+1234567894',
                'password' => Hash::make('password123'),
                'wallet_balance' => 800.00
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
