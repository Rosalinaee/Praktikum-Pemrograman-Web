<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('admin'), // Ganti jika perlu
            'role' => 'admin',
        ]);

        // User Biasa
        User::updateOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'User Biasa',
            'password' => Hash::make('password'), // Ganti jika perlu
            'role' => 'user',
        ]);
    }
}
