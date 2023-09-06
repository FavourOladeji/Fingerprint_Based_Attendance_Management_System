<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserType;
use App\Models\Schedule;
use App\Enums\ColourCode;
use App\Models\Attendance;
use App\Enums\AttendanceStatus;
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
            'name' => 'Ajadi Ayegbeni',
            'email' => 'admin@example.com',
            'user_type' => UserType::Admin->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Oladeji Favour',
            'email' => 'student@example.com',
            'user_type' => UserType::Student->value,
            'password' => Hash::make('password'),
            'matric_number' => '125/18/1/0117'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Atunbi Jesuferanmi',
            'email' => 'studentq@example.com',
            'user_type' => UserType::Student->value,
            'password' => Hash::make('password'),
            'matric_number' => '125/18/1/0118'
        ]);

        \App\Models\User::factory()->create([
            'name' => fake()->name(),
            'email' => 'Ayoade Idowu',
            'user_type' => UserType::Lecturer->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Adeaga Oyetunde',
            'email' => 'lecturer1@example.com',
            'user_type' => UserType::Lecturer->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Computer Science',
            'lecturer_id' => 3,
            'code' => 'MTE502',
            'colour_code' => ColourCode::Green->value
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Computer Science 2',
            'lecturer_id' => 4,
            'code' => 'MTE 504',
            'colour_code' => ColourCode::Purple->value
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Cyber Science',
            'lecturer_id' => 3,
            'code' => 'MTE506',
            'colour_code' => ColourCode::Sky->value

        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Engineering Drawing',
            'lecturer_id' => 3,
            'code' => 'MTE508',
            'colour_code' => ColourCode::LightRed->value

        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Instrumentation',
            'lecturer_id' => 3,
            'code' => 'MTE510',
            'colour_code' => ColourCode::Yellow->value

        ]);

        Schedule::factory()->create([
            'course_id' => 1,
            'day' => 'Thursday',
            'time' => Schedule::getHours()['nine'],
        ]);

        Attendance::factory()->create([
            'user_id' => 2,
            'schedule_id' => 1,
            'status' => AttendanceStatus::Present->value,
            'created_at' => now()
        ]);
    }
}
