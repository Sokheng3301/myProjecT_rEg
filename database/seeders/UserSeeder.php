<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users
        // \App\Models\User::factory(10)->create();
        // Create 1 admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin123',
            'email' => 'sokheng@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
