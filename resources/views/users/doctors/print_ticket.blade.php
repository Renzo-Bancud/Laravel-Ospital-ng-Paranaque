@extends('layouts.dashboard')

@section('content')
<style>
    .contain {
        border: 1px solid black;
        padding: 10px;
        font-size: 14px;
    }

    .flex-inputs {
        display: flex;
        padding: 10px;
    }

    .print-input {
        width: 100%;
        border: none;
        text-align: center;
        border-bottom: 1px solid black;
        outline: none;
    }

    .inline-input {
        display: flex;
    }

    .uppercase {
        text-transform: uppercase;
    }

    @media print {
        @page {
            margin: 0;
            padding: 0;
            size: auto;
        }

        #printButton {
            display: none;
        }

        .hide-back {
            display: none;
        }

        @page {
            size: landscape;
            width: 8.5in;
            height: 8.5in;
        }

        .navbar,
        .footer,
        .navbar-menu-wrapper,
        .card-header,
        .sidebar {
            display: none !important;
        }

        .card {
            border: none !important;
            padding: auto !important;
            margin: auto !important;

        }

        .card-body {
            padding: 0 !important;
        }

        .contain {
            margin-top: -80px;
            font-size: 13px;
        }

        .inline-input {
            margin: top -50px;
        }

        /* 
        <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12"> */
        .home-tab,
        .main-panel,
        .row {
            padding: 0 !important;

        }

        .print-tr {
            background: gray !important;
            color: #555 !important;
        }

    }

    .td_center {
        text-align: center;
    }

    .print-table {
        width: 100%;
        border: 2px solid black;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .print-tr {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        background: gray !important;
        color:whitesmoke;
       
    }

    .print-th {
        border-bottom: 2px solid black;
    }

    .print-td {
        border-bottom: 2px solid black;
    }

    .print-td-right {
        border-right: 2px solid black;
    }

    .print-th-right {
        border-right: 2px solid black;
    }

    .print-td-topright {

        border-right: 2px solid black;
        border-top: 2px solid black;
    }
</style>
<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-header d-flex justify-content-between">
                            <button id="printButton" class="btn btn-dark text-white">Print Ticket</button>
                            <a href="#" onclick="window.history.back();" class="btn btn-info btn-sm text-right hide-back"><span class="iconify fs-20" data-icon="ion:arrow-undo"></span>&nbsp;Go Back</a>
                        </div>
                        <div class="card-body">


                            <div class="contain">
                                <center class="uppercase">
                                    <b>OSPITAL NG PARAÑAQUE – DISTRICT II</b><br>
                                    <b><small><u>Charge Ticket</u></small></b><br><br>
                                </center>
                                <div class="flex-inputs">
                                    <div style="width:30%;" class="inline-input">
                                        <span class="uppercase" style="width:170px;">Ticket Number</span><span>:</span><input class="print-input" readonly value="{{ $print_dept->ticket_number }}">
                                    </div>
                                    <div style="width:40%;"></div>

                                    <div style="width:30%;" class="inline-input">
                                    <span class="uppercase" style="width:100px;">Department</span><span>:</span><input class="print-input" readonly value="{{ $print_dept->name }}">
                                    </div>
                                </div>

                                <table class="print-table">
                                    <tr class="print-tr">
                                        @if(Auth::user()->type == 2 && Auth::user()->dept_id == 2)
                                          <td class="print-th print-td-right uppercase">Medicine</td>
                                          <td class="print-th print-td-right uppercase">Medicine Category</td>
                                          <td class="print-th print-td-right uppercase">Quantity</td>
                                          <td class="print-th print-td-right uppercase">Amount</td>
                                          <td class="print-th print-td-right uppercase">Total</td>
                                        @else
                                        <td class="print-th print-td-right uppercase">Test</td>
                                        <td class="print-th print-td-right uppercase">Category</td>
                                        <td class="print-th print-td-right uppercase">Quantity</td>
                                        <td class="print-th print-td-right uppercase">Amount</td>
                                        <td class="print-th print-td-right uppercase">Total</td>
                                        @endif
                                         
                                        
                                    </tr>

                                    @forelse($print_tickets as $pt)
                                    <tr>
                                        
                                        @if(Auth::user()->type == 2 && Auth::user()->dept_id == 2)
                                        <td class="print-td print-td-right td_center">{{ $pt->medicine }}</td>
                                        <td class="print-td print-td-right td_center">{{ $pt->name}}</td>
                                        <td class="print-td print-td-right td_center">{{ $pt->qty }}</td>
                                        <td class="print-td print-td-right td_center">{{ number_format($pt->amount,2) }}</td>
                                        <td class="print-td print-td-right td_center">{{ number_format($pt->amount * $pt->qty, 2) }}</td>
                                        @else
                                        <td class="print-td print-td-right td_center">{{ $pt->test }}</td>
                                        <td class="print-td print-td-right td_center">{{ $pt->name }}</td>
                                        <td class="print-td print-td-right td_center">{{ $pt->qty }}</td>
                                        <td class="print-td print-td-right td_center">{{ number_format($pt->amount,2) }}</td>
                                        <td class="print-td print-td-right td_center">{{ number_format($pt->amount * $pt->qty, 2) }}</td>
                                        @endif
                                        
                                        
                                      
                                    
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="print-td print-td-right">No Data</td>
                                    </tr>
                                    @endforelse
                                    @php
                                    $sum = 0;
                                    $sum_extra = array_sum($print_tickets->pluck('amount')->toArray());
                                    @endphp
                                    <tr>
                                        <td style="border-right:none;"></td>
                                        <td style="border-right:none;"></td>
                                        <td style="border-right:none;"></td>
                                        <td class="print-td print-td-right" style="text-align:right;"><h3>Grand Total:</h3></td>
                                        <td class="print-td print-td-right td_center">&#8369; &nbsp;&nbsp; 
                                       

                                        @foreach ($print_tickets as $ticket)
                                        @php
                                        $sum += $ticket->amount * $ticket->qty;
                                        @endphp
                                        @endforeach
                                        {{ number_format($sum,2) }}

                                        </td>
                                
                                    </tr>


                                </table>
                                <div class="flex-inputs" style="margin-top:30px;">
                                    <div style="width:80%;">

                                    </div>


                                    <div style="width:20%;" class="inline-input">
                                        <div style="text-align:center;margin-right:auto 0;" class="uppercase">
                                            <input class="print-input"><br>
                                            Medical Social Worker on Duty
                                        </div>
                                    </div>



                                </div>

                                <!-- <div style="text-align:center;margin-top:30px;" class="uppercase">
                                    <h2>Charge Ticket</h2>
                                </div> -->

                            </div>



                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- begin:: Content -->

        <script>
            document.getElementById("printButton").addEventListener("click", function() {
                window.print();
            });
        </script>

        @endsection