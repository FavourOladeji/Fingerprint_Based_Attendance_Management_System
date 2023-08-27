@extends('admin.layouts.app')
@push('scripts')
    @include('admin.components.flash')
@endpush('scripts')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}" type="text/css">
@endsection
@section('content')
    <form action="{{ route('timetable.save') }}" method="POST">

        <div class="page-header d-md-flex justify-content-between">
            <div class="">

                <h3>Edit the Timetable</h3>

            </div>
            <div class="mt-3 mt-md-0">
                <button type="button" class="btn btn-success btn-uppercase ml-0 ml-md-2 mt-2 mt-md-0" data-toggle="modal"
                    data-target="#submitTimetable">
                    <i class="ti-check-box mr-2"></i> Save
                </button>
                <a href="{{ route('timetable.index') }}" class="btn btn-danger btn-uppercase ml-0 ml-md-2 mt-2 mt-md-0">
                    <i class="ti-na mr-2"></i> Cancel
                </a>
            </div>

        </div>


        <div class="row">
            <div class="col-md-12">

                @csrf
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
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
                                    @include('admin.timetable.components.timetable-select', [
                                        'time' => 'nine',
                                    ])
                                </tr>

                                <tr>
                                    <td class="align-middle">10:00am</td>
                                    @include('admin.timetable.components.timetable-select', [
                                        'time' => 'ten',
                                    ])
                                </tr>

                                <tr>
                                    <td class="align-middle">11:00am</td>
                                    @include('admin.timetable.components.timetable-select', [
                                        'time' => 'eleven',
                                    ])
                                </tr>

                                <tr>
                                    <td class="align-middle">12:00pm</td>
                                    @include('admin.timetable.components.timetable-select', [
                                        'time' => 'twelve',
                                    ])
                                </tr>

                                <tr>
                                    <td class="align-middle">01:00pm</td>
                                    @include('admin.timetable.components.timetable-select', [
                                        'time' => 'thirteen',
                                    ])
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="submitTimetable" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content panel-warning">
                    <div class="modal-header panel-heading">
                        <h5 class="modal-title text-danger">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">You can't change the timetable later in the future</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
