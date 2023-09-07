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
                                    <h4 class="card-title card-title-dash">Complete Requests Procedure</h4>
                                </div>
                            </div>
                            <div class="mt-1">
                               
                            <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Ticket Number</th>
                                            <th>Department</th>
                                            <th>Patient</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Fund Type</th>
                                            <th>Request Status</th>
                                            <th>Date Request</th>
                                         
                                         

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients as $pr)

                                        <tr>
                                            <td>
                                                <p>{{$pr->patient_ticket}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->name}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->firstname.' '.$pr->lastname}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->bday}}</p>
                                            </td>
                                            <td style="width:100px;">
                                                <p>{{$pr->age }}</p>
                                            </td>
                                            <td  style="width:100px;">
                                                <p>{{$pr->gender }}</p>
                                            </td>

                                            <td>
                                                <p>{{$pr->address == null ? 'No specified address' : $pr->address }}</p>
                                            </td>

                                            <td>
                                                <p>{{$pr->fund_type == null ? 'No specified fund' : $pr->fund_type  }}</p>
                                            </td>

                                            <td style="width:150px;">
                                            <!-- {{$pr->request_status == 0 ? 'Pending' : 
                                            ($pr->request_status == 1 ? 'Awaiting Approval' :
                                            ($pr->request_status == 2 ? 'Disapproved' :
                                            ($pr->request_status == 3 ? 'Approved' :
                                            ($pr->request_status == 4 ? 'Complete' : 'Unknown Status'))))
                                            }} -->
                                            {{ $pr->request_status == 4 ? 'Complete' : '' }}
                                            </td>

                                            <td style="max-width:180px;">
                                                {{ $pr->date_request.' '.date('l',strtotime($pr->date_request))}}
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

        <!-- begin:: Content -->

        @endsection

     