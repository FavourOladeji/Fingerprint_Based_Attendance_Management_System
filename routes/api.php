<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('check-to-add-id', [ApiController::class, 'checkToAddId']);
Route::get('confirm-adding', [ApiController::class, 'confirmAddingID']);
Route::get('check-mode', [ApiController::class, 'checkMode']);
Route::get('store-attendance', [ApiController::class, 'storeAttendance']);
Route::get('delete-fingerprint', [ApiController::class, 'deleteFingerprint']);

Route::post('fingerprint/enroll', [ApiController::class, 'enroll'])->name('fingerprint.enroll');
Route::get('fingerprint/verify', [ApiController::class, 'verify'])->name('fingerprint.verify');

Route::get('attendance', [\App\Http\Controllers\AttendanceController::class, 'getAllAttendanceData'])->name('get.attendance.data');
Route::get('attendance/schedule', [\App\Http\Controllers\AttendanceController::class, 'getAllAttendanceForSchedule'])->name('get.attendance.schedule.data');
