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
                                    <h4 class="card-title card-title-dash">Statement of Billing</h4>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button onclick="exportToExcel()" class="btn btn-secondary text-white">Export to
                                    Excel</button>
                                <div style="overflow-y: scroll; max-height: 400px;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th colspan="3" style="border:1px solid pink;">Radiology</th>
                                            <th></th>
                                            <th></th>

                                        </tr>

                                        <tr class="text-center">
                                            <th>Seq<br>No.</th>
                                            <th>Patient's Name</th>
                                            <th>O.R. No.</th>
                                            <th>Date Paid</th>
                                            <th>Pharmacy</th>
                                            <th>Laboratory</th>
                                            <th>Hemodialysis</th>
                                            <th>X-ray</th>
                                            <th>Ultrasound</th>
                                            <th>C.T. Scan</th>

                                            <th>Senior/PWD<br> ID No.</th>
                                            <th>Payable to Premier 101<br>(Gen Fund MOOE)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $seq_no = 1; ?>
                                        @forelse($patients as $patient)
                                        <tr class="text-center">
                                            <td>{{ $seq_no }}</td>
                                            <td>{{ $patient->firstname.' '.$patient->lastname }}</td>
                                            <td>{{ $patient->patient_ticket }}</td>
                                            <td>{{ $patient->date_paid == null ? 'Pending' : $patient->date_paid }}</td>
                                            <td>
                                                @if($patient->dept_id == 2)
                                                {{ $patient->price }}
                                                @else
                                                -&nbsp;-
                                                @endif
                                            </td>
                                            <td>
                                                @if($patient->dept_id == 1)
                                                {{ $patient->price }}
                                                @else
                                                -&nbsp;-
                                                @endif
                                            </td>
                                            <td>
                                                @if($patient->dept_id == 4)
                                                {{ $patient->price }}
                                                @else
                                                -&nbsp;-
                                                @endif
                                            </td>

                                            <td>
                                                @if($patient->dept_id == 3 && $patient->category_id == 1 )
                                                {{ $patient->price }}
                                                @else
                                                -&nbsp;-
                                                @endif
                                            </td>
                                            <td>
                                                @if($patient->dept_id == 3 && $patient->category_id == 2 )
                                                {{ $patient->price }}
                                                @else
                                                -&nbsp;-
                                                @endif
                                            </td>
                                            <td>
                                                @if($patient->dept_id == 3 && $patient->category_id == 3 )
                                                {{ $patient->price }}
                                                @else
                                                -&nbsp;-
                                                @endif
                                            </td>

                                            <td>-&nbsp;-</td>
                                            <td>0.00</td>
                                        </tr>
                                        <?php $seq_no++; ?>
                                        @empty
                                        No Data
                                        @endforelse


                                    </tbody>
                                    <tfoot class="text-center">
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            <?php
                                            $pharmacy_sum = 0;
                                            foreach ($patients as $patient) {
                                                if ($patient->dept_id == 2) {
                                                    $pharmacy_sum += $patient->price;
                                                }
                                            }
                                            echo number_format($pharmacy_sum,2);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $lab_sum = 0;
                                            foreach ($patients as $patient) {
                                                if ($patient->dept_id == 1) {
                                                    $lab_sum += $patient->price;
                                                }
                                            }
                                            echo number_format($lab_sum,2);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $hemodialysis_sum = 0;
                                            foreach ($patients as $patient) {
                                                if ($patient->dept_id == 4) {
                                                    $hemodialysis_sum += $patient->price;
                                                }
                                            }
                                            echo number_format($hemodialysis_sum,2);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $xray_sum = 0;
                                            foreach ($patients as $patient) {
                                                if ($patient->dept_id == 3 && $patient->category_id == 1) {
                                                    $xray_sum += $patient->price;
                                                }
                                            }
                                            echo number_format($xray_sum,2);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $ultrasound_sum = 0;
                                            foreach ($patients as $patient) {
                                                if ($patient->dept_id == 3 && $patient->category_id == 2) {
                                                    $ultrasound_sum += $patient->price;
                                                }
                                            }
                                            echo number_format($ultrasound_sum,2);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $ctscan_sum = 0;
                                            foreach ($patients as $patient) {
                                                if ($patient->dept_id == 3 && $patient->category_id == 3) {
                                                    $ctscan_sum += $patient->price;
                                                }
                                            }
                                            echo number_format($ctscan_sum,2);
                                            ?>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right !important;" class="d-none"><b>Grand Total:</b>&nbsp;<?php echo number_format($pharmacy_sum + $lab_sum + $hemodialysis_sum + $xray_sum + $ultrasound_sum + $ctscan_sum,2); ?></td>
                                    </tr>
                                </tfoot>
                                </table>
                                </div>

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
                onOpen: function () {
                    var modalss = document.getElementsByClassName("swal-modal")[0];
                    modalss.style.backgroundColor = "rgba(0, 0, 0, 0)";
                }
            }).then(function () {
                document.getElementById('logout-form').submit();
            });
        </script>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        @endif

        <!-- begin:: Content -->

        @endsection