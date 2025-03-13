<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'John Manager',
                'email' => 'john.manager@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Sarah Staff',
                'email' => 'sarah.staff@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Mike Technician',
                'email' => 'mike.tech@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Lisa Analyst',
                'email' => 'lisa.analyst@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}