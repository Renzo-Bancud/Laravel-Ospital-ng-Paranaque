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
                                    <h4 class="card-title card-title-dash">Complete Requests</h4>

                                </div>
                            </div>
                            <div class="mt-1">

                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Ticket Number</th>
                                            <th>Patient</th>
                                            <th>Department</th>
                                            <th>Grand Total</th>
                                            <th class="text-center">Request Status</th>
                                            <th class="text-center">Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients as $patient)
                                        <tr>
                                            <td>
                                                <p>{{$patient->patient_ticket}}</p>
                                            </td>
                                            <td>
                                                <p>{{$patient->firstname.' '.$patient->lastname}}</p>
                                            </td>
                                            <td>
                                                <p>{{$patient->name}}</p>
                                            </td>
                                            <td>


                                                @if($patient->dep_id == 2)
                                                @php
                                                $medsum = 0;
                                                @endphp
                                                @foreach($charge_request_meds as $crm)
                                                @php
                                                $medsum += $crm->qty * $crm->amount;
                                                @endphp
                                                @endforeach
                                                {{ number_format($medsum,2) }}
                                                <!-- Pharmacy -->

                                                @elseif($patient->dep_id == 3)


                                                @php
                                                $sum_radiology = 0;
                                                @endphp
                                                @foreach($charge_requests as $cr)
                                                @php
                                                $sum_radiology += $cr->amount;
                                                $type = $cr->radiology_type;
                                                @endphp

                                                @endforeach

                                                {{ number_format($sum_radiology,2) }}

                                                <!-- Radiology-->

                                                @elseif($patient->dep_id == 1)


                                                @php
                                                $lab_sum = 0;
                                                @endphp
                                                @foreach($lab_requests as $lr)
                                                @php
                                                $lab_sum += $lr->amount;
                                                @endphp

                                                @endforeach

                                                {{ number_format($lab_sum,2) }}

                                                <!-- Laboratory -->

 
                                                @else


                                                @php
                                                $dl_sum = 0;
                                                @endphp
                                                @foreach($dialysis_requests as $dr)
                                                @php
                                                $dl_sum += $dr->amount;
                                                @endphp

                                                @endforeach

                                                {{ number_format($dl_sum,2) }}

                                                <!-- Dialysis -->


                                                @endif
                                            </td>

                                            </td>
                                            <td class="text-center">
                                                <p> {{ $patient->request_status == null ? "Pending" :
                                                    ($patient->request_status == 3 ? "Approved" : "Complete") }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p>{{$patient->updated_at}}</p>
                                            </td>

                                            <td class="text-center">
                                            <a href="{{ route('get-amount_ticket',[ $patient->pid, $patient->patient_ticket ])}}" class="btn btn-success btn-sm p-2 text-white"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span>&nbsp;View Request</a>
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
