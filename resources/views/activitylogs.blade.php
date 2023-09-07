@extends('layouts.dashboard')

@section('content')

<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        @if(Auth::user()->type == 1)
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Activity Logs</h4>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>User Type</th>
                                            <th>Activity Type</th>
                                            <th>IP Address</th>
                                            <th>Device Information</th>
                                            <th>Details</th>
                                            <!-- <th>Status</th> -->
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @forelse($logs as $log)
                                        <tr>
                                            <td style="max-width:150px;">{{ $log->first_name.' '.$log->last_name }}</td>
                                            <td>{{ $log->user_type }}</td>
                                            <td>{{ $log->activity_type }}</td>
                                            <td>{{ $log->ip_address }}</td>
                                            <td  style="max-width:500px;">{{ $log->device_info}}</td>
                                            <td>{{ $log->details }}</td>
                                            <!-- <td>{{ $log->logstatus }}</td> -->
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

  
        @else

        <script>
            Swal.fire({
                title: "Intruder!",
                text: "You need to contact administrator to access this page.",
                icon: "warning",
                confirmButtonText: "OK",
                onOpen: function() {
                    var modalss = document.getElementsByClassName("swal-modal")[0];
                    modalss.style.backgroundColor = "rgba(0, 0, 0, 0)";
                }
            }).then(function() {
                document.getElementById('logout-form').submit();
            });
        </script>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        @endif

        <!-- begin:: Content -->

        @endsection