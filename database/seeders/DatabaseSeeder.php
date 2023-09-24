<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\DeviceMode;
use App\Enums\UserType;
use App\Models\Device;
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
            'name' => 'Oyewumi Abdsamad',
            'email' => 'student3@example.com',
            'user_type' => UserType::Student->value,
            'password' => Hash::make('password'),
            'matric_number' => '125/18/1/0119'
        ]);


        \App\Models\User::factory()->create([
            'name' => 'Ayoade Idowu',
            'email' => 'random@gmail.com',
            'user_type' => UserType::Lecturer->value,
            'password' => Hash::make('password')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Adeaga Oyetunde',
            'email' => 'lecturer1@example.com',
            'user_type' => UserType::Lecturer->value,
            'password' => Hash::make('password')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Agboluaje Abdulmalik',
            'email' => 'student4@example.com',
            'user_type' => UserType::Student->value,
            'password' => Hash::make('password'),
            'matric_number' => '125/18/1/0110'
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Computer Science',
            'lecturer_id' => 5,
            'code' => 'MTE502',
            'colour_code' => ColourCode::Green->value
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Computer Science 2',
            'lecturer_id' => 6,
            'code' => 'MTE 504',
            'colour_code' => ColourCode::Purple->value
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Cyber Science',
            'lecturer_id' => 5,
            'code' => 'MTE506',
            'colour_code' => ColourCode::Sky->value

        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Engineering Drawing',
            'lecturer_id' => 5,
            'code' => 'MTE508',
            'colour_code' => ColourCode::LightRed->value

        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Instrumentation',
            'lecturer_id' => 6,
            'code' => 'MTE510',
            'colour_code' => ColourCode::Yellow->value

        ]);

//        Schedule::factory()->create([
//            'course_id' => 1,
//            'day' => 'Monday',
//            'time' => Schedule::getHours()['eleven'],
//        ]);
//
//        Attendance::factory()->create([
//            'user_id' => 2,
//            'schedule_id' => 1,
//            'status' => AttendanceStatus::Present->value,
//            'created_at' => now()
//        ]);
//
//        Attendance::factory()->create([
//            'user_id' => 3,
//            'schedule_id' => 1,
//            'status' => AttendanceStatus::Present->value,
//            'created_at' => now()
//        ]);
//
//        Attendance::factory()->create([
//            'user_id' => 7,
//            'schedule_id' => 1,
//            'status' => AttendanceStatus::Present->value,
//            'created_at' => now()
//        ]);

        Device::factory()->create([
            'name' => 'test',
            'location' => 'NLT',
            'uid' => '1234',
            'mode' => DeviceMode::Enrollment->value
        ]);
    }
}
