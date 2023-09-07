@extends('layouts.dashboard')

@section('content')

<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Time Schedule</h4>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="row mt-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <center>
                                            <table class="table select-table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-uppercase">&nbsp;<b>Week Day:</b></div>
                                                        </td>
                                                        <td>
                                                            <div>&nbsp; {{$timeschedule->week_day}}</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-uppercase">&nbsp;<b>Start Time:</b></div>
                                                        </td>
                                                        <td>
                                                            <div>&nbsp; {{$timeschedule->start_time}}</div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="text-uppercase">&nbsp;<b>End Time:</b></div>
                                                        </td>
                                                        <td>
                                                            <div>&nbsp; {{$timeschedule->end_time}}</div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="text-uppercase">&nbsp;<b>Appointment Duration:</b></div>
                                                        </td>
                                                        <td>
                                                            <div>&nbsp;{{$timeschedule->duration}}</div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="text-uppercase">&nbsp;<b>

                                                                    @if($users->type == 2)
                                                                    Doctor
                                                                    @elseif($users->type == 3)
                                                                    Patient
                                                                    @elseif($users->type == 4)
                                                                    Nurse
                                                                    @elseif($users->type == 5)
                                                                    Accountant
                                                                    @elseif($users->type == 6)
                                                                    Laboratorist
                                                                    @elseif($users->type == 7)
                                                                    Pharmacist
                                                                    @elseif($users->type == 8)
                                                                    Receptionist
                                                                    @else
                                                                    Position not Found
                                                                    @endif
                                                                    :</b></div>
                                                        </td>

                                                        <td>
                                                            {{$users['first_name'] == null ? 'No User Firstname' : $users['first_name']  }}
                                                            {{$users['last_name'] == null ? 'No User Lastname' : $users['last_name']  }}
                                                        </td>
                                                    </tr>





                                                </tbody>
                                            </table>
                                        </center>

                                    </div>
                                    <div class="col-sm-3"></div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- begin:: Content -->

        @endsection