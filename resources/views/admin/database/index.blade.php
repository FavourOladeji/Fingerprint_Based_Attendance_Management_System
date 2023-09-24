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

            <h3>View the Database of all users</h3>

        </div>
        <div class="mt-3 mt-md-0">
            <button href="{{ route('timetable.create') }}"
                class="btn btn-outline-secondary btn-uppercase ml-0 ml-md-2 mt-2 mt-md-0" data-toggle="modal"
                data-target="#addNewUser">
                <i class="ti-plus mr-2"></i> Add new User
            </button>
            <div class="modal" tabindex="-1" role="dialog" id="addNewUser">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add a new User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ route('database.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="matric_number">Matric Number</label>
                                        <input type="matric_number" name="matric_number" class="form-control"
                                            id="matric_number" placeholder="125/XX/X/XXX">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" name="department" class="form-control" id="department"
                                        placeholder="">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="userType">User Type</label>
                                        <select id="userType" name="user_type" class="form-control">
                                            @foreach ($userTypes as $userType)
                                                <option value="{{ $userType }}">{{ ucwords($userType) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="userType">Select Device</label>
                                        <select id="userType" name="user_type" class="form-control">
                                            @foreach ($devices as $device)
                                                <option value="{{ $device->uid }}">{{ ucwords($device->name) }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fingerprint_id">Fingerprint ID</label>
                                        <input type="number" name="fingerprint_id" class="form-control" id="fingerprint_id"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="">Place your Finger on the device</label>
                                    <span style="width: 100%; height: 50%; font-size: 14px"
                                        class="alert alert-danger text-center">Fingerprint
                                        is not Added</span>
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
                data-target="#addNewUser">Add New User</button> --}}
        </div>

    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Users</h6>

                <div class="table-responsive text-center table-striped table-bordered">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Name</th>
                                <th scope="col">Matric Number</th>
                                <th scope="col">UserType</th>
                                <th scope="col">Fingerprint</th>
                                <th scope="col">Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @forelse ($users as $user)
                                @php
                                    $count += 1;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $count }}</th>
                                    <th>
                                        <figure class="avatar avatar-sm">
                                            <img src="{{ asset('assets/media/image/user/women_avatar5.jpg') }}"
                                                class="rounded-circle" alt="image">
                                        </figure>
                                    </th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->matric_number ?? '' }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $user->user_type_colour_code }}">{{ ucwords($user->user_type->value) }}</span>
                                    </td>
                                    <td>
                                        @if($user->fingerprint?->status == \App\Enums\FingerprintStatus::Added )
                                            <a disabled class="btn btn-success">Enrolled</a>
                                        @else
                                            <a class="btn btn-info" href="{{route('database.show', ['user_id' => $user->id])}}">Enroll</a>
                                        @endif

                                    </td>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6">There are no records at the moment</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
