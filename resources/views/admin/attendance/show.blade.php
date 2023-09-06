@extends('admin.layouts.app')
@push('scripts')
    @include('admin.components.flash')
    <script src="{{ asset('assets/js/examples/pages/customers.js') }}"></script>
@endpush('scripts')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}" type="text/css">
@endsection
@section('content')
    <div class="page-header d-md-flex justify-content-between">
        <div class="">

            <h3>Attendance for {{ $courseCode }} ({{ Carbon\Carbon::parse($date)->format('M d, Y') }})</h3>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Total Students</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                            <i class="ti-id-badge"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">{{ 65 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Present Today</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-success-bright text-success rounded-pill">
                                            <i class="ti-check-box"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">{{ 40 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Late Today</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-danger-bright text-danger rounded-pill">
                                            <i class="ti-cloud"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">{{ 10 }}</div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Absent Today</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-warning-bright text-secondary rounded-pill">
                                            <i class="ti-face-sad"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">{{ 15 }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Attendance Log</h6>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Matric Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Checked In</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $attendance)
                                    <tr>
                                        <th scope="row">1</th>
                                        <th>
                                            <figure class="avatar avatar-sm">
                                                <img src="{{ asset('assets/media/image/user/women_avatar5.jpg') }}"
                                                    class="rounded-circle" alt="image">
                                            </figure>
                                        </th>
                                        <td>{{ $attendance->user->name }}</td>
                                        <td>{{ $attendance->user->matric_number ?? '' }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $attendance->status_colour_code }}">{{ ucwords($attendance->status->value) }}</span>
                                        </td>
                                        <td>{{ $attendance->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            There are no records of any attendance for this schedule
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
