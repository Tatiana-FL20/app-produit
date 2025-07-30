<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Utilisateur',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'type' => 'user',
        ]);
    }
}
