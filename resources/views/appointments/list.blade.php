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
                                    <h4 class="card-title card-title-dash">Manage appointments</h4>
                                    <p class="card-subtitle card-subtitle-dash">List of created appointments</p>
                                </div>
                                <div>

                                    <a href="{{route('appointments.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0">
                                        <span class="iconify fs-20 text-white" data-icon="map:accounting"></span>&nbsp;Add appointment</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Patient</th>
                                            <th>Doctor</th>
                                            <th>Department</th>
                                            <th>Date/Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->patient['first_name'] == null ? 'No Patient Firstname' : $appointment->patient['first_name']   }}</td>
                                            <td>{{$appointment->doctor['first_name'] == null ? 'No Doctor Firstname' : $appointment->doctor['first_name']  }}</td>
                                            <td>{{$appointment->department->name}}</td>
                                            <td>{{$appointment->date.' / '.$appointment->time}}</td>
                                            <td>{{$appointment->status}}</td>
                                            <td>
                                                <div class="d-flex">

                                                    <a href="{{route('appointments.show',$appointment->id)}}" class="btn  btn-secondary fs-5 text-white p-2"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span></a>

                                                    <a href="{{route('appointments.edit',$appointment->id)}}" class="btn  btn-success fs-5 text-white p-2"><span class="iconify" data-icon="tabler:edit"></span></a>

                                                    <form action="{{route('appointments.destroy',$appointment->id)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn  btn-danger fs-5 text-white p-2"><span class="iconify" data-icon="iwwa:trash"></span></button>
                                                    </form>
                                                </div>
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