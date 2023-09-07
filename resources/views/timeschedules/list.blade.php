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
                                    <h4 class="card-title card-title-dash">Manage Time Schedules</h4>
                                    <p class="card-subtitle card-subtitle-dash">List of time schedules</p>
                                </div>
                                <div>

                                    <a href="{{isset($doctor) ? route('create-time-schedule-for-doctor',$doctor->id) : route('timeschedules.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0">

                                        <span class="iconify fs-20 text-white" data-icon="ic:twotone-more-time"></span>
                                        Add time schedule</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Week Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Appointment Duration</th>
                                            <th>Name</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($doctor))
                                        @foreach($doctor->timeSchedules as $timeschedule)
                                        <tr>
                                            <td>{{$timeschedule->week_day}}</td>
                                            <td>{{$timeschedule->start_time}}</td>
                                            <td>{{$timeschedule->end_time}}</td>
                                            <td>{{$timeschedule->duration.' Minute'}}</td>
                                            <td>




                                                {{ $timeschedule->user['first_name'] == null ? 'No Doctor Name' : $timeschedule->user['first_name'] }}
                                            </td>


                                            <td>
                                                <div class="d-flex">

                                                    <a href="{{route('timeschedules.show',$timeschedule->id)}}" class="btn  btn-secondary fs-5 text-white p-2"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span></a>

                                                    <a href="{{route('timeschedules.edit',$timeschedule->id)}}" class="btn  btn-success fs-5 text-white p-2"><span class="iconify" data-icon="tabler:edit"></span></a>

                                                    <form action="{{route('timeschedules.destroy',$timeschedule->id)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn  btn-danger fs-5 text-white p-2"><span class="iconify" data-icon="iwwa:trash"></span></button>
                                                    </form>
                                                </div>
                                            </td>


                                        </tr>
                                        @endforeach
                                        @else
                                        @foreach($timeschedules as $timeschedule)
                                        <tr>
                                            <td>{{$timeschedule->week_day}}</td>
                                            <td>{{$timeschedule->start_time}}</td>
                                            <td>{{$timeschedule->end_time}}</td>
                                            <td>{{$timeschedule->duration.' Minute'}}</td>
                                            <td>
                                                <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">
                                                    
                                                    <b>
                                                    @if($timeschedule->user['type'] == 2)
                                                    Doctor
                                                    @elseif($timeschedule->user['type'] == 3)
                                                    Patient
                                                    @elseif($timeschedule->user['type'] == 4)
                                                    Nurse
                                                    @elseif($timeschedule->user['type'] == 5)
                                                    Accountant
                                                    @elseif($timeschedule->user['type'] == 6)
                                                    Laboratorist
                                                    @elseif($timeschedule->user['type'] == 7)
                                                    Pharmacist
                                                    @elseif($timeschedule->user['type'] == 8)
                                                    Receptionist
                                                    @else
                                                    Position not Found
                                                    @endif
                                                    :
                                                    </b>

                                                    {{$timeschedule->user['first_name'] == null ? 'No Name' : $timeschedule->user['first_name']  }}</span>
                                            </td>

                                            <td>
                                                <div class="d-flex">

                                                    <a href="{{route('timeschedules.show',$timeschedule->id)}}" class="btn  btn-secondary fs-5 text-white p-2"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span></a>

                                                    <a href="{{route('timeschedules.edit',$timeschedule->id)}}" class="btn  btn-success fs-5 text-white p-2"><span class="iconify" data-icon="tabler:edit"></span></a>

                                                    <form action="{{route('timeschedules.destroy',$timeschedule->id)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn  btn-danger fs-5 text-white p-2"><span class="iconify" data-icon="iwwa:trash"></span></button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @endif
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

        @section('scripts')

        @endsection