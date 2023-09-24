@foreach ($days as $day)
    @php
        $scheduleSortedByHour = $schedules->where(function ($schedule) use ($hours, $time) {
            return $schedule->time == $hours[$time];
        });
    @endphp

    @include('admin.attendance.components.timetable-slot')
@endforeach
