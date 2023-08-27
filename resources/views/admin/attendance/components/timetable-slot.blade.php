@if ($schedulesAtNineByDay = $schedulesAtNine->where('day', $day)->first())
    <td>
        <span
            class="bg-{{ $schedulesAtNineByDay->course->colour_code }} padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $schedulesAtNineByDay->course->code }}</span>
        <div class="margin-10px-top font-size14">{{ Carbon\Carbon::parse($schedulesAtNineByDay->time)->format('H:i') }}
        </div>
        <div class="font-size13 text-light-gray">
            {{ $schedulesAtNineByDay->course->lecturer->name }}</div>
    </td>
@else
    <td class="bg-light-gray">

    </td>
@endif
