@foreach ($days as $day)
    @php
        $schedulesAtNine = $schedules->where(function ($schedule) use ($hours, $time) {
            return $schedule->time == $hours[$time];
        });
    @endphp

    @include('admin.timetable.components.timetable-slot')
@endforeach
