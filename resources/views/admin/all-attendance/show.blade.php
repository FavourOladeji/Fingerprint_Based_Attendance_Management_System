@extends('admin.layouts.app')
@push('scripts')
    @include('admin.components.flash')
    <script>
        // Function to update the table with new data
        function updateTable() {
            $.ajax({
                url: '{{route('get.attendance.data')}}', // Replace with your server-side script URL
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Clear the existing table rows
                    console.log(data);
                    console.log('Number of rows to insert:', data.attendances.length);

                    $('#dynamicTable tbody').empty();
                    var count;
                    // Iterate through the data and add rows to the table
                    $('#totalUsers').text(data.totalUsers);
                    $('#usersPresentToday').text(data.usersPresentToday);
                    $('#usersAbsentToday').text(data.usersAbsentToday);
                    $('#usersLateToday').text(data.usersLateToday);
                    $.each(data.attendances, function (index, attendance) {
                        console.log('here');
                        count += 1;
                        let newRow = $('<tr>');
                        newRow.append($('<th>').text(index + 1)); // Count
                        newRow.append($('<th>').html('<figure class="avatar avatar-sm"><img src="{{ asset('assets/media/image/user/women_avatar5.jpg') }}" class="rounded-circle" alt="image"></figure>')); // Avatar
                        newRow.append($('<td>').text(attendance.user.name)); // Name
                        newRow.append($('<td>').text(attendance.created_at)); // Created At
                        newRow.append($('<td>').text(attendance.timeout)); // Created At

                        $('#dynamicTable tbody').append(newRow);
                        console.log(newRow);
                    });
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // Update the table every 5 seconds (5000 milliseconds)
        setInterval(updateTable, 5000);

        // Initial update
        updateTable();
    </script>
@endpush('scripts')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}" type="text/css">
@endsection
@section('content')
    <div class="page-header d-md-flex justify-content-between">
        <div class="">

            <h3>Attendance for {{ Carbon\Carbon::parse($date)->format('M d, Y') }}</h3>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Total Users</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                            <i class="ti-id-badge"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3" id="totalUsers"></div>
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
                                <div class="font-weight-bold ml-1 font-size-30 ml-3" id="usersPresentToday"></div>
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
                                <div class="font-weight-bold ml-1 font-size-30 ml-3" id="usersLateToday"></div>
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
                                <div class="font-weight-bold ml-1 font-size-30 ml-3" id="usersAbsentToday"></div>
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
                        <table class="table" id="dynamicTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Checked In</th>
                                    <th scope="col">Time Out</th>
                                </tr>
                            </thead>
                            <tbody id="dynamicTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
