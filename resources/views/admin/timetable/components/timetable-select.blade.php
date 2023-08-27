@foreach ($days as $day)
    <td>
        <div class="form-group">
            <select name="{{ $time }}[{{ $day }}]" class="form-control" id="">
                <option selected value="">None</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </td>
@endforeach
