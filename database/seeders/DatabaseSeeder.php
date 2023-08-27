<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\ColourCode;
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

        \App\Models\User::factory()->create([
            'name' => 'Lecturer User',
            'email' => 'lecturer@example.com',
            'user_type' => UserType::Lecturer->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Lecturer1 User',
            'email' => 'lecturer1@example.com',
            'user_type' => UserType::Lecturer->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Computer Science',
            'lecturer_id' => 3,
            'code' => 'CSC101',
            'colour_code' => ColourCode::Green->value
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Computer Science 2',
            'lecturer_id' => 4,
            'code' => 'CSC201',
            'colour_code' => ColourCode::Purple->value
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Cyber Science',
            'lecturer_id' => 3,
            'code' => 'CSC301',
            'colour_code' => ColourCode::Sky->value

        ]);
    }
}
