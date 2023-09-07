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
                                    <h4 class="card-title card-title-dash">Charge Tickets</h4>
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
                                            

                                            {{$pr->request_status == 0 ? 'Pending' : 
                                            ($pr->request_status == 3 ? 'Approved' :
                                            ($pr->request_status == 4 ? 'Complete' : 'Unknown Status'))
                                            }}
                                            </td>

                                            <td style="max-width:180px;">
                                                {{ $pr->date_request.' '.date('l',strtotime($pr->date_request))}}
                                            </td>

                                            <td>
                                             <a href="{{ route('get-amount_ticket',[ $pr->pid, $pr->patient_ticket ])}}" class="btn btn-success btn-sm p-2 text-white"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span>&nbsp;Show Amount</a>
                
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


        <div class="modal fade" id="maketicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Charge Ticket</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('ticket-generate') }}">
                            @csrf

                            <input id="uid" type="hidden" name="uid">
                            <input id="rid" type="hidden" name="rid">
                            <input id="did" type="hidden" name="did">

                            <table class="border-0 w-100" id="service_table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-control" name="test[]" placeholder="Enter type of test" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="amount[]" placeholder="Amount" required style="max-width:135px;margin-left:13px;">
                                        </td>
                                        <td><button type="button" onclick="removeRows(this)" class="btn btn-danger rounded-0 p-2"><span class="iconify fs-20" data-icon="tabler:trash-x"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pull-right">
                                <button type="button" onclick="addRows()" class="btn btn-dark btn-sm text-white rounded-0  mb-2 mt-2"> <span class="iconify fs-20" data-icon="material-symbols:library-add-outline"></span>&nbsp;Add Row</button>
                            </div>

                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Submit Ticket</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- begin:: Content -->
        @endsection