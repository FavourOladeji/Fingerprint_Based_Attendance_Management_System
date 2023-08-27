<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Course;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Schedule::$days;
        $hours = Schedule::getHours();

        $schedules = Schedule::query()->with('course.lecturer:id,name')->get(['time', 'day', 'id', 'course_id']);

        // Check if timetable has already been created
        $canEdit = $schedules->count() > 0 ? false : true;

        return view('admin.timetable.index', ['schedules' => $schedules, 'days' => $days, 'hours' => $hours, 'canEdit' => $canEdit]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (Schedule::query()->count() > 0) {
            toastr('error', 'You cannot edit the timetable');
            return redirect(route('timetable.index'));
        }
        $days = Schedule::$days;
        $courses = Course::all();
        return view('admin.timetable.create', ['courses' => $courses, 'days' => $days]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $validatedInputs = collect($request->validated());
        $hours = Schedule::getHours();
        $payload = [];

        foreach ($validatedInputs as $time => $values) {
            $hour = $hours["$time"];
            foreach ($values as $day => $course_id) {
                if ($course_id) {
                    $payload[] = [
                        'course_id' => $course_id,
                        'time' => $hour,
                        'day' => $day
                    ];
                }
            }
        }

        foreach ($payload as $data) {
            $schedule = new Schedule;
            $schedule->course_id = $data['course_id'];
            $schedule->time = $data['time'];
            $schedule->day = $data['day'];
            $schedule->save();
        }
        toastr()->success('You have successfully created the timetable');
        // dd($request);
        return redirect(route('timetable.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
