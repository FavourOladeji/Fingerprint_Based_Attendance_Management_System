<?php

namespace App\Http\Controllers;

use App\Enums\AttendanceStatus;
use App\Enums\UserType;
use App\Http\Requests\AttendanceFilterRequest;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Schedule::$days;
        $hours = Schedule::getHours();


        $currentTimeframe = request()->timeframe ?? now()->startOfWeek();

        $timeframes = $this->getTimeframes(53);
        // foreach ($timeframes as $timeframe) {
        //     dd($timeframe);
        // }
        $schedules = Schedule::query()->with('course.lecturer:id,name')->get(['time', 'day', 'id', 'course_id']);

        // Check if timetable has already been created

        return view('admin.attendance.index', [
            'currentTimeframe' => $currentTimeframe,
            'timeframes' => $timeframes,
            'days' => $days,
            'hours' => $hours,
            'schedules' => $schedules
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($scheduleId, $date)
    {
        $totalStudents = User::query()->where('user_type', UserType::Student->value)->count();
        $attendances = Attendance::query()->with(['user', 'schedule.course'])->where('schedule_id', $scheduleId)->whereDate('created_at', $date)->get();
        $studentsPresentToday = Attendance::query()->where('schedule_id', $scheduleId)->whereDate('created_at', $date)->where('status', AttendanceStatus::Present->value)->count();
        $studentsLateToday = Attendance::query()->where('schedule_id', $scheduleId)->whereDate('created_at', $date)->where('status', AttendanceStatus::Late->value)->count();
        $studentsAbsentToday = $totalStudents - ($studentsPresentToday + $studentsLateToday);
        $courseCode = $attendances[0]->schedule->course->code;
        // dd($studentsAbsent);
        // dd($attendances);
        // $studentsPresentToday = $attendances->where('status', '=',  'present');
        // dd($studentsPresentToday);
        return view('admin.attendance.show', [
            'attendances' => $attendances,
            'totalStudents' => $totalStudents,
            'studentsPresentToday' => $studentsPresentToday,
            'studentsLateToday' => $studentsLateToday,
            'studentsAbsentToday' => $studentsAbsentToday,
            'courseCode' => $courseCode,
            'date' => $date,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function filter(AttendanceFilterRequest $request)
    {
    }

    public function getTimeframes(int $numberOfWeeks)
    {
        $timeframes = [];
        for ($week = 0; $week < $numberOfWeeks; $week++) {
            $timeframes[now()->startOfWeek()->subWeeks($week)->format('d-m-Y') . ' to ' . now()->startOfWeek()->subWeeks($week)->next('Friday')->format('d-m-Y')] = [
                'from' => now()->startOfWeek()->subWeeks($week), 'to' => now()->startOfWeek()->subWeeks($week)->next('Friday')->endOfDay()
            ];
        }
        return $timeframes;
    }
}
