<?php

use App\Enums\AttendanceStatus;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Models\Attendance;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
})->name('admin.');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/timetable', [ScheduleController::class, 'index'])->name('timetable.index');

Route::get('timetable/create', [ScheduleController::class, 'create'])->name('timetable.create');

Route::post('timetable/save', [ScheduleController::class, 'store'])->name('timetable.save');

Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('attendance/save', function () {
    Attendance::query()->create([
        'user_id' => 1,
        'schedule_id' => 1,
        'status' => AttendanceStatus::Present->value,
        'created_at' => now()->startOfWeek()->next('Tuesday')
    ]);
    // dd(now()->startOfWeek()->next('Tuesday'));
});
Route::get('attendance/show/{scheduleId}/{date}', [AttendanceController::class, 'show'])->name('attendance.show');
Route::post('attendance/filter', [AttendanceController::class, 'filter'])->name('attendance.filter');

Route::get('database', [DatabaseController::class, 'index'])->name('database.index');
Route::post('database/store', [DatabaseController::class, 'store'])->name('database.store');
