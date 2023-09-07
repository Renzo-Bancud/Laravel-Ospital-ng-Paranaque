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
                                    <h4 class="card-title card-title-dash">Appointment Detail</h4>
                                </div>

                            </div>
                            <div class="mt-1" style="display:flex;justify-content:center">
                                <div class="w-100" style="max-width:500px;">
                                    <center>
                                        <table class="table select-table table-bordered mt-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Doctor:</b></div>
                                                    </td>
                                                    <td>
                                                        @if(strpos($doctor->picture,'doctors_pictures')!==false)
                                                        <img src="{{asset('storage/'.$doctor->picture)}}" class="img-circle kt-widget__img rounded">
                                                        @else
                                                        <img src="{{$doctor->picture}}" class="img-circle kt-widget__img rounded">
                                                        @endif <br>

                                                        {{$doctor->first_name}} {{$doctor->last_name}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Patient:</b></div>
                                                    </td>
                                                    <td>
                                                        @if(strpos($patient['picture'],'patients_pictures')!==false)
                                                        <img src="{{asset('storage/'.$patient['picture'])}}" class="img-circle kt-widget__img rounded">
                                                        @else
                                                        <img src="{{$patient['picture']}}" class="img-circle kt-widget__img rounded">
                                                        @endif <br>

                                                        {{ $patient['first_name'] == null && $patient['last_name'] == null ? 
                                                            'No Name' : $patient['first_name'].' '.$patient['last_name'] }} 
                                                        
                                                  

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Department:</b></div>
                                                    </td>
                                                    <td>
                                                        {{ $department['name'] }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Date:</b></div>
                                                    </td>
                                                    <td>
                                                        {{ $Appointment->date }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Time:</b></div>
                                                    </td>
                                                    <td>
                                                        {{ $Appointment->time }}
                                                    </td>
                                                </tr>

                                        
                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Status:</b></div>
                                                    </td>
                                                    <td>
                                                        {{ $Appointment->status }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="text-uppercase">&nbsp;<b>Notes:</b></div>
                                                    </td>
                                                    <td>
                                                        {{ $Appointment->notes }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- begin:: Content -->

        @endsection

        @section('scripts')

        @endsection