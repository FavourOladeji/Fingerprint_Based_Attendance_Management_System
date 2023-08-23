@extends('admin.layouts.app')
@section('content')
    <div class="content ">
        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Welcome back, Bony</h3>
                <p class="text-muted">This page shows an overview of the attendance of the institution.</p>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
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
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3">0.16%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3">12.87%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3">12.87%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3">12.87%</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-2">Monthly Financial Status</h6>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-floating">
                                    <i class="ti-reload"></i>
                                </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ti-more-alt"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mb-4">Check how you're doing financially for current month</p>
                        <div id="sales"></div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-primary">
                                <i class="ti-download mr-2"></i> Create Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
