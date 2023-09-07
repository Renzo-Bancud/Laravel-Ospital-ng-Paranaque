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

        @page {
            size: landscape;
            height: 8.5in;
        }



        .modal-dialog {
            display: none;
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
            width: 100%;
        }

        .card-body {
            padding: 0 !important;
        }

        .contain {
            margin-top: -80px;
            font-size: 11.5px;
        }

        .inline-input {
            margin: top -50px;
        }


        .home-tab,
        .main-panel,
        .row {
            padding: 0 !important;

        }

        .print-input-bday{
            width:2700px;
            margin-left:20px;
        }

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
                            <button id="printButton" class="btn btn-dark text-white">Print</button>
                            <a href="#" onclick="window.history.back();" class="btn btn-info btn-sm text-right hide-back"><span class="iconify fs-20" data-icon="ion:arrow-undo"></span>&nbsp;Go Back</a>
                        </div>


                        <div class="card-body">


                            <div class="contain">
                                <center class="uppercase">
                                    <b>OSPITAL NG PARAÑAQUE – DISTRICT II</b><br>
                                    <b><small><u>Patient Identification Card</u></small></b><br><br>
                                </center>

                                <center>
                                    <span style="text-align:left;font-weight:normal;font-size:12px;">Hospital No.</span>
                                    <div style="padding:10px;border: 2px solid #555;width:300px;">
                                        <h3><b>{{ $patient->patient_ticket }}<b></h3>
                                    </div>


                                    <div class="flex-inputs" style="width:600px;margin-top:20px;">
                                        <div style="width:100%;" class="inline-input">
                                            <span style="width:100px;" class="uppercase">Pangalan<br>(Name)</span><input class="print-input" readonly value="{{ $patient->firstname.' '.$patient->lastname}}">
                                        </div>
                                    </div>

                                    <div class="flex-inputs" style="width:600px;margin-top:20px;">
                                        <div style="width:100%;" class="inline-input">
                                            <span style="width:100px;" class="uppercase">Address<br>(Tirahan)</span><input class="print-input" readonly value="{{ $patient->address }}">
                                        </div>
                                    </div>

                                    <div class="flex-inputs flex-input-bday" style="width:600px;margin-top:20px;position:relative;left:-20px;">
                                        <div style="width:100%;" class="inline-input">
                                            <span style="width:140px;" class="uppercase">Birthday<br>(Pinanganak)</span><input class="print-input print-input-bday" readonly value="{{ $patient->bday}}">
                                        </div>
                                    </div>


                                </center>




                        




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