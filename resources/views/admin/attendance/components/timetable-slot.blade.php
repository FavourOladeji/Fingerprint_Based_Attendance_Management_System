@if ($ScheduleSortedByDay = $scheduleSortedByHour->where('day', $day)->first())
    @if ($loop->first)
        @php
            $date = $currentTimeframe;
        @endphp
    @else
        @php
            $date = Carbon\Carbon::parse($currentTimeframe)->next($day);
        @endphp
    @endif
    <td class="filled">
        <a href="{{ route('attendance.show', ['scheduleId' => $ScheduleSortedByDay->id, 'date' => $date]) }}">
            <span
                class="bg-{{ $ScheduleSortedByDay->course->colour_code }} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $ScheduleSortedByDay->course->code }}</span>
            <div class="margin-10px-top font-size14">
                {{ Carbon\Carbon::parse($ScheduleSortedByDay->time)->format('H:i') }}
            </div>
            <div class="font-size13">
                {{ $ScheduleSortedByDay->course->lecturer->name }}</div>
        </a>
    </td>
@else
    <td class="bg-light-gray">

    </td>
@endif
