<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'user_type' => UserType::Admin->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'user_type' => UserType::Student->value,
            'password' => Hash::make('password')
        ]);
    }
}
