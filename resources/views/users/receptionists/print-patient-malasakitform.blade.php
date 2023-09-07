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
        text-align:center;
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
            size: legal;
            margin: 0;

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

        .x-ray-class{
            width:85px;
        }

        .ct-scan-class{
            width:83px;
        }

        .ultrasound-class{
            width:150px;
        }

        .card-body {
            padding: 0 !important;
        }

        .contain{
            margin-top:-80px;
            font-size:11.5px;
        }

        .inline-input{
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

        .to-print-input{
        width:420px;
        }

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
                        <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <button id="printButton" class="btn btn-dark text-white">Print Form</button>
                            <a href="#" onclick="window.history.back();" class="btn btn-info btn-sm text-right hide-back"><span class="iconify fs-20" data-icon="ion:arrow-undo"></span>&nbsp;Go Back</a>
                            </div>
                    
                        </div>
                        <div class="card-body">


                            <div class="contain">
                                <center class="uppercase">
                                    <b>OSPITAL NG PARAÑAQUE – DISTRICT II</b><br>
                                    <b><small><u>Medical Social Service Section/Malasakit Center</u></small></b><br><br>
                                    <b>Classification Form</b>
                                </center>
                                <div class="flex-inputs">
                                    <div style="width:40%;">
                                    </div>
                                    <div style="width:40%;"></div>

                                    <div style="width:20%;" class="inline-input">
                                        <span class="uppercase">Date</span><span>:</span><input class="print-input" readonly id="thedate" >
                                    </div>
                                </div>

                                <div class="flex-inputs">
                                    <div style="width:60%;" class="inline-input">
                                        <span style="width:285px;" class="uppercase">Name</span><span>:</span><input class="print-input"  value="{{ $patient->firstname.'   '.$patient->lastname}}">
                                    </div>

                                    <div style="width:20%;" class="inline-input">
                                        <span class="uppercase">Age</span><span>:</span><input class="print-input"  value="{{ $patient->age }}">
                                    </div>

                                    <div style="width:20%;" class="inline-input">
                                        <span class="uppercase">Gender</span><span>:</span><input class="print-input"  value="{{ $patient->gender }}">
                                    </div>
                                </div>


                                <div class="flex-inputs">
                                    <div style="width:80%;" class="inline-input">
                                        <span style="width:260px;" class="uppercase">Address</span><span>:</span><input class="print-input"  value="{{ $patient->address }}">
                                    </div>

                                    <div style="width:20%;" class="inline-input">
                                        <span class="uppercase">Status</span><span>:</span><input class="print-input">
                                    </div>
                                </div>

                                <div class="flex-inputs">
                                    <div style="width:100%;" class="inline-input">
                                        <span style="width:250px;" class="uppercase">Clinical Impression</span><span>:</span><input class="print-input">
                                    </div>
                                </div>

                                <div class="flex-inputs">
                                    <div style="width:100%;" class="inline-input">
                                        <span style="width:250px;" class="uppercase">Assesment</span><span>:</span><input class="print-input">
                                    </div>
                                </div>

                

                                <div class="flex-inputs" style="justify-content:space-between;margin-top:20px;">
                                    <div>

                                    </div>


                                    <div class="inline-input">
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Medical Social Worker on Duty
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="contain" style="margin-top:10px;">
                                <center><b>CERTIFICATE OF INDIGENCY</b></center>
                                @php
                                $identity = $patient->gender == 'male' ? 'Mr.' : 'Ms.';
                                @endphp
                                <div class="flex-inputs" style="margin-top:20px;">
                                    <div style="width:70%;" class="inline-input">
                                        <span style="width:170px">This is to certify that</span><input class="print-input" value="{{ $identity }}  {{ 
                                            $patient->firstname.'   '.$patient->lastname}}">
                                    </div>
                                    <div style="width:30%;" class="inline-input">
                                        <span>of</span><input class="print-input" value="{{ $patient->address}}">
                                    </div>
                                </div>

                               
                                <div class="flex-inputs">
                                    <div style="width:100%;" class="inline-input">
                                        <span style="width:320px">is a needy patient with a classification of</span><input class="print-input">
                                    </div>
                                </div>


                                <div class="flex-inputs">
                                    <div style="width:100%;" class="inline-input">
                                        <span style="width:1300px">He / She is entitled to the medical privileges and other related benefits in this hospital:</span><input class="print-input">
                                    </div>
                                </div>

                                <div class="flex-inputs" style="justify-content:space-between;margin-top:20px;">

                                    <div>
                                        Approved By:
                                        <br><br>
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Medical Social Worker on Duty
                                        </div>
                                    </div>

                                    <div>
                                        Noted By:

                                        <div>
                                            <br><br>
                                            <b class="uppercase">Mary Jean F. Ona, RSW</b><br>
                                            <small>Chief. Medical Service<br>
                                                Program Manager, Malasakit Center
                                            </small>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="contain" style="margin-top:10px;" p>
                                <small><b>PREMIER 101 HEALTHCARE MANAGEMENT, INC.</b></small>
                                <center class="uppercase" style="margin-top:20px;"><b>Acknowledgement Form</b></center>


                                <div class="flex-inputs" style="margin-top:20px;">
                                    <div style="width:70%;" class="inline-input">
                                        <span style="width:50px;margin-left:20px;">Ako si</span><input class="print-input"      value="{{ $patient->firstname.'   '.$patient->lastname}}">,
                                    </div>
                                    <div style="width:30%;" class="inline-input">
                                        <input class="print-input"  value="{{ $patient->age}}"><span style="width:190px">taong gulang</span>
                                    </div>
                                </div>

                                <div class="flex-inputs">
                                    <div style="width:100%;" class="inline-input">
                                        <span style="width:180px">nakatira sa</span><input class="print-input" value="{{ $patient->address}}"> <span style="width:870px">ay nagpapatunay na ang sumusunod na pamamaraan</span>
                                    </div>
                                </div>
                                <div class="flex-inputs">
                                    ay naisasagawa / gamot ay naibigay sa akin:
                                </div>

                              
                                <table class="print-table">
                                    <tr class="print-tr" style="text-align:center;">
                                        <td class="print-th print-td-right uppercase">laboratory</td>
                                        <td class="print-th print-td-right uppercase">pharmacy</td>

                                        <td class="print-td print-td-right uppercase" style="padding:0px;">
                                            <br>
                                            <span>Radiology</span>
                                            <br><br>
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-topright x-ray-class" style="min-width:85px">x-ray</td>
                                                    <td class="print-td-topright ultrasound-class" style="max-width:93px">ultrasound</td>
                                                    <td class="ct-scan-class" style="border-top:2px solid black;min-width:85px;">ct-scan</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-th uppercase">dialysis</td>
                                    </tr>

                                    <tr>
                                        <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>

                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;"><span style="visibility:hidden;">a</span></span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;"><span style="visibility:hidden;">a</span></span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;"><span style="visibility:hidden;">a</span></span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;"><span style="visibility:hidden;">a</span></span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;"><span style="visibility:hidden;">a</span></span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;"><span style="visibility:hidden;">a</span></span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>


                                    <tr>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                       <td class="print-td print-td-right"><span style="visibility:hidden;">a</span></td>
                                        <td class="print-td print-td-right" style="padding:0px;">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class="print-td-right"><span style="visibility:hidden;">a</span></td>
                                                    <td class=""><span style="visibility:hidden;">a</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="print-td"><span style="visibility:hidden;">a</span></td>
                                    </tr>




                                </table>

                                <div style="display:flex;">
                                    <div style="width:20%;padding:10px;">
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Laboratory
                                        </div>
                                    </div>
                                    <div style="width:20%;padding:10px;">
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Pharmacy
                                        </div>
                                    </div>
                                    <div style="width:20%;padding:10px;">
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Radiology
                                        </div>
                                    </div>
                                    <div style="width:20%;padding:10px;">
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Dialysis
                                        </div>
                                    </div>
                                    <div style="width:20%;padding:10px;">
                                        <div style="text-align:center;" class="uppercase">
                                            <input class="print-input"><br>
                                            Pasyente/Kamag-anak/Petsa
                                        </div>
                                    </div>
                                </div>

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