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
        $date = strval($date);
        $courseCode = Schedule::query()->with('course')->find($scheduleId)->course->code;
        return view('admin.attendance.show', [
            'courseCode' => $courseCode,
            'date' => $date,
            'scheduleId' => $scheduleId
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

    public function allAttendance(Request $request)
    {

        return view('admin.all-attendance.show', [
            'date' => now()
        ]);
    }

    public function getAllAttendanceData(Request $request)
    {
        $date = $request->date ?? now();
        $totalUsers = User::query()->count();
        $attendances = Attendance::query()->with(['user'])->whereDate('created_at', $date)->latest('updated_at')->get();
//        dd($attendances);
        $usersPresentToday = User::query()->whereHas('attendances', function ($query) use ($date) {
            $query->whereDate('created_at', $date)->where('status', AttendanceStatus::Present);
        })->count();
        $usersLateToday = User::query()->whereHas('attendances', function ($query) use ($date) {
            $query->whereDate('created_at', $date)->where('status', AttendanceStatus::Late);
        })->count();
        $usersAbsentToday = $totalUsers - ($usersPresentToday + $usersLateToday);

        return response()->json([
            'attendances' => $attendances,
            'totalUsers' => $totalUsers,
            'usersPresentToday' => $usersPresentToday,
            'usersLateToday' => $usersLateToday,
            'usersAbsentToday' => $usersAbsentToday,
        ]);
    }

    public function getAllAttendanceForSchedule(Request $request)
    {
        $date = $request->date;
        $scheduleId = $request->schedule_id;
        $totalStudents = User::query()->where('user_type', UserType::Student->value)->count();
        $attendances = Attendance::query()->with(['user', 'schedule.course'])->where('schedule_id', $scheduleId)->whereDate('created_at', $date)->latest('updated_at')->get();
        $studentsPresentToday = Attendance::query()->where('schedule_id', $scheduleId)->whereDate('created_at', $date)->where('status', AttendanceStatus::Present->value)->count();
        $studentsLateToday = Attendance::query()->where('schedule_id', $scheduleId)->whereDate('created_at', $date)->where('status', AttendanceStatus::Late->value)->count();
        $studentsAbsentToday = $totalStudents - ($studentsPresentToday + $studentsLateToday);
        $courseCode = Schedule::query()->with('course')->find($scheduleId)->course->code;
//        dd($courseCode);
        // dd($studentsAbsent);
        // dd($attendances);
        // $studentsPresentToday = $attendances->where('status', '=',  'present');
        // dd($studentsPresentToday);
        return response()->json([
            'attendances' => $attendances,
            'totalStudents' => $totalStudents,
            'studentsPresentToday' => $studentsPresentToday,
            'studentsLateToday' => $studentsLateToday,
            'studentsAbsentToday' => $studentsAbsentToday,
            'courseCode' => $courseCode,
            'date' => $date,
        ]);
    }
}
