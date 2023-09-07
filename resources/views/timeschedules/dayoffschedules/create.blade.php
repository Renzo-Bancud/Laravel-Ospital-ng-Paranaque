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
                                    <h4 class="card-title card-title-dash">{{isset($dayoffschedule) ? 'Edit Day off Schedule Info' : 'Add Day off Schedule'}}</h4>
                                </div>

                            </div>
                            <div class="mt-1">
                                <div class="w-100">
                                    <form class="kt-form kt-form--label-right" action="{{isset($dayoffschedule) ? route('dayoffschedules.update',$dayoffschedule->id) : route('dayoffschedules.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($dayoffschedule))
                                        @method('PUT')
                                        @endif

                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label>Schedule For</label>

                                                    <select class="form-control" id="usertype" name="usertype" >
                                                        <option value="">Select User Type</option>
                                                        <option value="2">doctor</option>
                                                        <option value="4">nurse</option>
                                                        <option value="5">accountant</option>
                                                        <option value="7">laboratorist</option>
                                                        <option value="6">pharmacist</option>
                                                        <option value="8">receptionist</option>
                                                    </select>

                                                </div>


                                                <div class="form-group" style="display:none;" id="userDiv">
                                                    <label>User</label>

                                                    <select class="form-control" id="user" name="user">
                                                    </select>

                                                </div>

                                                <div class="form-group">
                                                    <label>Date</label>

                                                    <input class="form-control" type="text" name="date" id="date" readonly placeholder="Select Date" @if(isset($appointment)) value="{{$appointment->date}}" @endif>

                                                </div>





                                            </div>


                                        </div>

                                        <input type="submit" value="{{isset($dayoffschedule) ? 'Update' : 'Submit'}}" class="btn-sm btn-primary">
                                        <input type="reset" class="btn-sm btn-danger" value="Cancel">

                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- begin:: Content -->
            @endsection