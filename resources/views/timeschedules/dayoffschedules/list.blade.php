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
                                    <h4 class="card-title card-title-dash">Manage Dayoff Schedules</h4>
                                    <p class="card-subtitle card-subtitle-dash">List of dayoff schedules</p>
                                </div>
                                <div>

                                    <a href="{{isset($doctor) ? route('create-time-schedule-for-doctor',$doctor->id) : route('dayoffschedules.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0">
                                        <span class="iconify fs-20 text-white" data-icon="uil:calendar-alt"></span>&nbsp;Add dayoff schedule</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dayoffschedules as $dayoffschedule)
                                        <tr>
                                            <td>
                                                <b>
                                                    @if($dayoffschedule->user['type'] == 2)
                                                    Doctor
                                                    @elseif($dayoffschedule->user['type'] == 3)
                                                    Patient
                                                    @elseif($dayoffschedule->user['type'] == 4)
                                                    Nurse
                                                    @elseif($dayoffschedule->user['type'] == 5)
                                                    Accountant
                                                    @elseif($dayoffschedule->user['type'] == 6)
                                                    Laboratorist
                                                    @elseif($dayoffschedule->user['type'] == 7)
                                                    Pharmacist
                                                    @elseif($dayoffschedule->user['type'] == 8)
                                                    Receptionist
                                                    @else
                                                    Position not Found
                                                    @endif
                                                    :
                                                </b>


                                                {{$dayoffschedule->user['first_name'].' '.$dayoffschedule->user['last_name']}}
                                            </td>
                                            <td>{{$dayoffschedule->date}}</td>
                                            <td>
                                                <div class="d-flex">

                                                    <a href="{{route('dayoffschedules.show',$dayoffschedule->id)}}" class="btn  btn-secondary fs-5 text-white p-2"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span></a>

                                                    <a href="{{route('dayoffschedules.edit',$dayoffschedule->id)}}" class="btn  btn-success fs-5 text-white p-2"><span class="iconify" data-icon="tabler:edit"></span></a>

                                                    <form action="{{route('dayoffschedules.destroy',$dayoffschedule->id)}}" method="post">
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