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
                                    <h4 class="card-title card-title-dash">{{isset($timeschedule) ? 'Edit Time Schedule Info' : 'Add Time Schedule'}}</h4>
                                </div>

                            </div>
                            <div class="mt-1">
                                <div class="w-100">
                                    <form id="timescheduleform" class="kt-form kt-form--label-right" action="{{isset($timeschedule) ? route('timeschedules.update',$timeschedule->id) : route('timeschedules.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($timeschedule))
                                        @method('PUT')
                                        @endif

                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label>Schedule For</label>

                                                    <select class="form-control" id="usertype" name="usertype">
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
                                                    <label>Start Time</label>

                                                    <input class="form-control timepicker" id="start_time" name="start_time" readonly placeholder="Select time" type="text" @if(isset($timeschedule)) value="{{$timeschedule->start_time}}" @endif>


                                                </div>
                                                <div class="form-group" id="endtimeDiv" style="display:none;">
                                                    <label>End Time</label>

                                                    <input class="form-control timepicker" id="end_time" name="end_time" readonly placeholder="Select time" type="text" @if(isset($timeschedule)) value="{{$timeschedule->end_time}}" @endif>

                                                </div>
                                                <div class="form-group">
                                                    <label>Week Day</label>

                                                    <select class="form-control" name="week_day" id="week_day">
                                                        <option value="saturday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'saturday' ? 'selected' : ''}} @endif>
                                                            Saturday
                                                        </option>
                                                        <option value="sunday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'sunday' ? 'selected' : ''}} @endif>
                                                            Sunday
                                                        </option>
                                                        <option value="monday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'monday' ? 'selected' : ''}} @endif>
                                                            Monday
                                                        </option>
                                                        <option value="tuesday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'tuesday' ? 'selected' : ''}} @endif>
                                                            Tuesday
                                                        </option>
                                                        <option value="wednesday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'wednesday' ? 'selected' : ''}} @endif>
                                                            Wednesday
                                                        </option>
                                                        <option value="thursday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'thursday' ? 'selected' : ''}} @endif>
                                                            Thursday
                                                        </option>
                                                        <option value="friday" @if(isset($timeschedule)) {{$timeschedule->week_day == 'friday' ? 'selected' : ''}} @endif>
                                                            Friday
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="form-group" id="durationDiv" style="display:none;">
                                                    <label>Appointment Duration</label>
                                                    <input type="number" class="form-control" name="duration" id="duration" min="0" step="1">
                                                    <div class="input-group-append"><span class="input-group-text">minute</span></div>

                                                </div>





                                            </div>


                                        </div>

                                        <input type="submit" value="{{isset($timeschedule) ? 'Update' : 'Submit'}}" class="btn-sm btn-primary">
                                        <input type="reset" class="btn-sm btn-danger" value="Cancel">

                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- begin:: Content -->


            <script>
                $("#usertype").change(function() {
                    $('#user').empty();

                    if ($(this).val() == '') {
                        $('#userDiv').hide();
                        $('#durationDiv').hide();
                    } else {
                        if ($(this).val() == 'doctor') {
                            $('#durationDiv').show();
                        } else {
                            $('#durationDiv').hide();
                        }
                        $.ajax({
                            url: "{{route('get-user-by-user-type')}}?usertype=" + $(this).val(),
                            method: 'GET',
                            success: function(data) {
                                jsonar = JSON.parse(data.html);
                                $.each(jsonar, function(i, value) {
                                    $('#user').append('<option value="' + jsonar[i].id + '">' + jsonar[i].first_name + ' ' + jsonar[i].last_name + '</option>');
                                });
                                $('#userDiv').show();
                            }
                        });
                    }

                });
            </script>


            @endsection