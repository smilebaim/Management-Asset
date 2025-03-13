<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ministry.gov',
            'password' => bcrypt('password')
        ]);

        // Create additional users
        User::factory(5)->create();

        // Seed departments first since assets depend on them
        $this->call([
            DepartmentSeeder::class,
            AssetSeeder::class,
        ]);
    }
}
