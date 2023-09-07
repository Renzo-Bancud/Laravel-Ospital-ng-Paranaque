@extends('layouts.dashboard')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">Patients</p>
                                            <h3 class="rate-percentage">{{ $count_patients }}</h3>
                                            @if($percentage_today_patients > 0)
                                            <p class="text-primary d-flex"><i
                                                    class="mdi mdi-menu-up"></i><span>+{{ number_format($percentage_today_patients,2)
                                                    }}%</span></p>
                                            @else
                                            <p class="text-danger d-flex"><i
                                                    class="mdi mdi-menu-down"></i><span>+{{$percentage_today_patients
                                                    }}%</span></p>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="statistics-title">Malasakit Accounts</p>
                                            <h3 class="rate-percentage">{{ $count_malasakits }}</h3>
                                            @if($percentage_today_malasakit > 0)
                                            <p class="text-primary d-flex"><i
                                                    class="mdi mdi-menu-up"></i><span>+{{ number_format($percentage_today_malasakit,2)
                                                    }}%</span></p>
                                            @else
                                            <p class="text-danger d-flex"><i
                                                    class="mdi mdi-menu-down"></i><span>+{{$percentage_today_malasakit}}%</span>
                                            </p>
                                            @endif



                                        </div>
                                        <div>
                                            <p class="statistics-title">Department Accounts</p>
                                            <h3 class="rate-percentage">{{ $count_departments }}</h3>
                                            @if($percentage_today_department > 0)
                                            <p class="text-primary d-flex"><i class="mdi mdi-menu-up"></i><span>+{{
                                                number_format($percentage_today_department,2) }}%</span></p>
                                            @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>+{{
                                                    $percentage_today_department}}%</span></p>
                                            @endif
                                        </div>
                                        <div class="d-none d-md-block">
                                            <p class="statistics-title">PPP Accounts</p>
                                            <h3 class="rate-percentage">{{ $count_ppps }}</h3>
                                            @if($percentage_today_ppp > 0)
                                            <p class="text-primary d-flex"><i class="mdi mdi-menu-up"></i><span>+{{
                                                    number_format($percentage_today_ppp,2) }}%</span></p>
                                            @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>+{{
                                                    $percentage_today_ppp }}%</span></p>
                                            @endif

                                        </div>
                                        <!-- <div class="d-none d-md-block">
                                            <p class="statistics-title">Admin Accounts</p>
                                            <h3 class="rate-percentage">68.8</h3>
                                         
                                        </div> -->
                                        <!-- <div class="d-none d-md-block">
                      <p class="statistics-title">Total Complete Request</p>
                      <h3 class="rate-percentage">2m:35s</h3>
                      <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                    </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-6 col-lg-4 col-lg-12 grid-margin stretch-card">
                                            <div class="card card-rounded" id="card-chart" style="height:530px;">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Completed Charge
                                                                Ticket Request</h4>
                                                            <h6 class="card-subtitle card-subtitle-dash"
                                                                style="font-size:12px;">Bar chart of total completed
                                                                sales for each month</h6>
                                                        </div>
                                                        <!-- <div id="performance-line-legend"></div> -->
                                                    </div>
                                                    <div class="chartjs-wrapper mt-2">
                                                        <div class="card-body" style="padding: 0">
                                                            <canvas id="charge-chart" style="height:400px;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!-- 
                                <div class="col-lg-4 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                                            <div class="card bg-primary card-rounded">
                                                <div class="card-body pb-0">
                                                    <h4 class="card-title card-title-dash text-white mb-4">Status
                                                        Summary</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="status-summary-ight-white mb-1">Closed Value</p>
                                                            <h2 class="text-info">357</h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="status-summary-chart-wrapper pb-4">
                                                                <canvas id="status-summary"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                                <div class="circle-progress-width">
                                                                    <div id="totalVisitors"
                                                                        class="progressbar-js-circle pr-2"></div>
                                                                </div>
                                                                <div>
                                                                    <p class="text-small mb-2">Total Visitors</p>
                                                                    <h4 class="mb-0 fw-bold">26.80%</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center">
                                                                <div class="circle-progress-width">
                                                                    <div id="visitperday"
                                                                        class="progressbar-js-circle pr-2"></div>
                                                                </div>
                                                                <div>
                                                                    <p class="text-small mb-2">Visits per day</p>
                                                                    <h4 class="mb-0 fw-bold">9065</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Charge Ticket Request
                                                                Status</h4>
                                                            <p class="card-subtitle card-subtitle-dash">



                                                                @if($count_pending_request > 0)
                                                                You have {{ $count_pending_request }}+ new requests
                                                                @else
                                                                You have 0 new request
                                                                @endif

                                                        </div>

                                                    </div>
                                                    <div  mt-1">
                                                        <table class="table select-table" id="data-table">
                                                            <thead>
                                                                <tr>

                                                                    <th>Patient</th>
                                                                    <th>Department</th>
                                                                    <th>Progress</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($patients as $patient)
                                                                <tr>
                                                                    <td>
                                                                        <p>{{ $patient->first_name.'
                                                                            '.$patient->last_name }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <p>{{ $patient->name }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <div>
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                                @if($patient->request_status == null)
                                                                                <p>40%</p>
                                                                                <p>40/100</p>
                                                                                @elseif($patient->request_status == 3)
                                                                                <p>80%</p>
                                                                                <p>80/100</p>
                                                                                @elseif($patient->request_status == 4)
                                                                                <p>100%</p>
                                                                                <p>100/100</p>
                                                                                @else
                                                                                <p>0%</p>
                                                                                <p>0/100</p>
                                                                                @endif
                                                                            </div>
                                                                            <div class="progress progress-md">
                                                                                @if($patient->request_status == null)
                                                                                <div class="progress-bar bg-warning"
                                                                                    role="progressbar"
                                                                                    style="width: 40%"
                                                                                    aria-valuenow="25" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                                @elseif($patient->request_status == 3)
                                                                                <div class="progress-bar bg-info"
                                                                                    role="progressbar"
                                                                                    style="width: 80%"
                                                                                    aria-valuenow="25" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                                @elseif($patient->request_status == 4)
                                                                                <div class="progress-bar bg-success"
                                                                                    role="progressbar"
                                                                                    style="width: 100%"
                                                                                    aria-valuenow="25" aria-valuemin="0"
                                                                                    aria-valuemax="100"></div>
                                                                                @else
                                                                                No Data
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>


                                                                        @if($patient->request_status == null)
                                                                        <div
                                                                            class="badge badge-opacity-warning bg-danger text-white">
                                                                            In progress
                                                                        </div>
                                                                        @elseif($patient->request_status == 3)
                                                                        <div class="badge badge-opacity-primary text-dark">
                                                                            Approve
                                                                        </div>
                                                                        @elseif($patient->request_status == 4)
                                                                        <div class="badge badge-opacity-success text-dark">
                                                                            Complete
                                                                        </div>
                                                                        @else
                                                                        No Data
                                                                        @endif

                                                    </div>
                                                    </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td>No Data</td>
                                                    </tr>
                                                    @endforelse

                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content-wrapper ends -->
    @endsection