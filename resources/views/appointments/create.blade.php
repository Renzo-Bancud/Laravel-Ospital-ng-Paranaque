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
                                    <h4 class="card-title card-title-dash">{{isset($appointment) ? 'Edit Appointment Info' : 'Add Appointment'}}</h4>
                                    <!-- <p class="card-subtitle card-subtitle-dash">List of created expenses</p> -->
                                </div>

                            </div>
                            <div class="mt-1" style="display:flex;justify-content:center">
                                <div class="w-100" style="max-width:500px;">
                                    <form class="kt-form kt-form--label-right" action="{{isset($appointment) ? route('appointments.update',$appointment->id) : route('appointments.store')}}" method="POST" enctype="multipart/form-data">
                                        <div class="kt-portlet__body">

                                            @csrf
                                            @if(isset($appointment))
                                            @method('PUT')
                                            @endif


                                            <div class="form-group">
                                                <label>Patient</label>

                                                @if(isset($patients))
                                                <select class="form-control" name="patient" id="patient">
                                                    <option value="0">select patient</option>
                                                    @foreach($patients as $patient)
                                                    <option value="{{$patient->id}}" @if(isset($appointment)) {{$patient->id == $appointment->patient_id ? 'selected' : ''}} @endif>{{$patient->first_name.''.$patient->last_name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif

                                            </div>
                                            <div class="form-group row" id="newPatientDiv">
                                                <div class="col-md-6">
                                                    <label>Patient First Name</label>

                                                    <input type="text" name="first_name" class="form-control">

                                                </div>
                                                <div class="col-md-6">
                                                    <label>Patient Last Name</label>

                                                    <input type="text" name="last_name" class="form-control">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label>

                                                @if(isset($departments))
                                                <select class="form-control" name="department" id="department">
                                                    <option>select department</option>
                                                    @foreach($departments as $department)
                                                    <option value="{{$department->id}}" @if(isset($appointment)) {{$department->id == $appointment->department_id ? 'selected' : ''}} @endif>{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif

                                            </div>
                                            <div class="form-group">
                                                <label>Doctor</label>

                                                <select class="form-control" name="doctor" id="doctor">
                                                    <option>select doctor</option>
                                                </select>

                                            </div>
                                            <div class="form-group" id="timeScheduleDiv" style="display: none">
                                                <label>Time Schedules</label>

                                                <ul class="list-group" id="timeSchedule">

                                                </ul>


                                            </div>
                                            <div class="form-group" id="dateDiv" style="display: none">
                                                <label>Date</label>

                                                <input class="form-control" type="text" name="date" id="appointment_date" readonly placeholder="Select Date" @if(isset($appointment)) value="{{$appointment->date}}" @endif>

                                            </div>
                                            <div class="form-group" id="timeSlotsDiv" style="display: none">
                                                <label>Available Slots</label>

                                                <select class="form-control" name="timeSlots" id="timeSlots">

                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>

                                                <select class="form-control" name="status" id="status">
                                                    <option value="confirmed">confirmed</option>
                                                    <option value="pending">pending</option>
                                                    <option value="cancelled">cancelled</option>
                                                </select>

                                            </div>
                                            <div class="form-group" id="priceDiv" style="display:none;">
                                                <label>Price</label>

                                                <input class="form-control" type="text" name="price" id="price" readonly>
                                                <input class="form-control" type="hidden" name="commission" id="commission">
                                                <input class="form-control" type="hidden" name="item" id="item">


                                            </div>
                                            <div class="form-group">
                                                <label>Notes</label>

                                                <textarea class="form-control" name="notes" id="notes"></textarea>


                                            </div>


                                        </div>

                                        <input type="submit" value="{{isset($appointment) ? 'Update' : 'Submit'}}" class="btn-sm btn-primary">
                                        <input type="reset" class="btn-sm btn-danger" value="Cancel">

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- begin:: Content -->

        @endsection



        <script>
            


           
        </script>