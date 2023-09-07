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
                                    <h4 class="card-title card-title-dash">Approve Requests Procedure</h4>
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
                                            <th>Action</th>
                                         

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
                                            {{ $pr->request_status == 3 ? 'Approved' : '' }}
                                            </td>

                                            <td style="max-width:180px;">
                                                {{ $pr->date_request.' '.date('l',strtotime($pr->date_request))}}
                                            </td>
                                            <td>

                                            <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#complete" 
                                            data-pid="{{$pr->pid}}" data-tid="{{$pr->patient_ticket}}"
                                            ><span class="iconify fs-30" data-icon="openmoji:check-mark-button"></span>&nbsp;Mark as Complete</button>
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


      
        <div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0 p-0">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close mt-2" style="position:relative;left:-15px;" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <form method="POST" action="{{ route('complete-patient-request') }}">
                            @csrf

                            <input id="pid" type="hidden" name="pid">
                            <input id="tid" type="hidden" name="tid">
                            <center>
                            <h1 class="lead text-center">Do you want mark the request as complete?</h1>
                            <small class="text-muted"><i>If the procedure is done you can mark it as complete.</i></small>
                            </center>
                            <div class="d-flex justify-content-center mt-3 mb-3">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>&nbsp;
                                <button type="submit" class="btn btn-primary">Yes, mark it!</button>

                            </div>
                        </form>



                    </div>

                </div>
            </div>
        </div>

        @endsection

     