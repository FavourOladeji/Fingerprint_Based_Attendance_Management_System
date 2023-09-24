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

            <h3>View All the Fingerprint Devices</h3>

        </div>
        <div class="mt-3 mt-md-0">
            <button href="{{ route('timetable.create') }}"
                    class="btn btn-outline-secondary btn-uppercase ml-0 ml-md-2 mt-2 mt-md-0" data-toggle="modal"
                    data-target="#addNewDevice">
                <i class="ti-plus mr-2"></i> Add new Device
            </button>
            <div class="modal" tabindex="-1" role="dialog" id="addNewDevice">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add a new Device</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('device.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                               placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="location">Location</label>
                                        <input type="location" name="location" class="form-control" id="location"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uid">UID</label>
                                    <input type="text" name="uid" class="form-control" id="uid" placeholder="">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <button href="#" class="btn btn-primary ml-0 ml-md-2 mt-2 mt-md-0" data-toggle="modal"
                data-target="#addNewDevice">Add New User</button> --}}
        </div>

    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Fingerprint Devices</h6>

                <div class="table-responsive text-center table-striped table-bordered">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">UID</th>
                            <th scope="col">Mode</th>
                            <th scope="col">Date Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @forelse ($devices as $device)
                            @php
                                $count += 1;
                            @endphp
                            <tr>
                                <th scope="row">{{ $count }}</th>
                                <td>{{ $device->name }}</td>
                                <td>{{ $device->location }}</td>
                                <td>{{ $device->uid }}</td>
                                <td>
                                    <a href="{{ route('device.update', ['device' => $device->id, 'mode' => \App\Enums\DeviceMode::Attendance]) }}"
                                       class="btn btn-{{ $device->mode == \App\Enums\DeviceMode::Attendance ? 'success' : 'light' }}">Attendance</a>
                                    <a href="{{ route('device.update', ['device' => $device->id, 'mode' => \App\Enums\DeviceMode::Enrollment]) }}"
                                       class="btn btn-{{ $device->mode == \App\Enums\DeviceMode::Enrollment ? 'success' : 'light' }}">Enrollment</a>
                                </td>
                                <td>{{ Carbon\Carbon::parse($device->created_at)->diffForHumans() }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6">There are no devices at the moment</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
