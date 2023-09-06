@extends('admin.layouts.app')
@push('scripts')
    @include('admin.components.flash')
@endpush('scripts')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}" type="text/css">
@endsection
@section('content')
    <div class="page-header d-md-flex justify-content-between">
        <div class="">

            <h3>View the Attendance for the Week</h3>

        </div>
        <div class="mt-3 mt-md-0">
            <form action="{{ route('attendance.index') }}" method="GET">
                <div class="form-row">
                    <div class="form-group">
                        <select name="timeframe" class="form-control">
                            @foreach ($timeframes as $timeframe)
                                @if ($loop->first)
                                    <option value="{{ $timeframe['from'] }}" selected>
                                        {{ $timeframe['from']->format('M d, Y') }} to
                                        {{ $timeframe['to']->format('M d, Y') }}</option>
                                @else
                                    <option value="{{ $timeframe['from'] }}"
                                        {{ request()->timeframe == $timeframe['from'] ? 'selected' : '' }}>
                                        {{ $timeframe['from']->format('M d, Y') }} to
                                        {{ $timeframe['to']->format('M d, Y') }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ml-0 ml-md-2 mt-2 mt-md-0">Filter</button>
                        <a href="{{ route('attendance.index') }}"
                            class="btn btn-secondary ml-0 ml-md-2 mt-2 mt-md-0">Reset</a>
                    </div>
                    {{-- <div id="dashboard-daterangepicker" class="btn btn-outline-light">
                        <span></span>
                    </div> --}}
                </div>
            </form>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-uppercase">Time
                                </th>
                                @foreach ($days as $day)
                                    <th class="text-uppercase">{{ $day }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">09:00am</td>
                                @include('admin.attendance.components.timetable-row', ['time' => 'nine'])

                            </tr>

                            <tr>
                                <td class="align-middle">10:00am</td>
                                @include('admin.attendance.components.timetable-row', ['time' => 'ten'])
                            </tr>

                            <tr>
                                <td class="align-middle">11:00am</td>
                                @include('admin.attendance.components.timetable-row', ['time' => 'eleven'])
                            </tr>

                            <tr>
                                <td class="align-middle">12:00pm</td>
                                @include('admin.attendance.components.timetable-row', ['time' => 'twelve'])
                            </tr>

                            <tr>
                                <td class="align-middle">01:00pm</td>
                                @include('admin.attendance.components.timetable-row', [
                                    'time' => 'thirteen',
                                ])
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
