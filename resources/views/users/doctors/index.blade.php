@extends('layouts.dashboard')

@section('content')
<style>
    .zoomed-image {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zoomed-image img {
        width: 100%;
        height: 100%;
        max-width: 300px;
        max-height: 300px;
    }
</style>
<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        @if(Auth::user()->type == 1)
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Department Staff</h4>
                                    <p class="card-subtitle card-subtitle-dash">You have {{ $count_doctor }} {{
                                        $count_doctor > 0 ? 'staffs' : 'staff' }} on the list</p>
                                </div>
                                <div>

                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addstaff"
                                        id="add-staff-modal" class="btn btn-primary btn-lg text-white mb-0 me-0"><i
                                            class="mdi mdi-account-plus"></i>Add Staff</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                    @if(count($doctors) > 0)
                                        <tr>
                                            <th>Profle</th>
                                            <th>Employee ID</th>
                                            <th>Email</th>
                                            <th>Birth Date</th>
                                            <th>Age</th>
                                            <th>Mobile #</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                    @else

                                    @endempty
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($doctors as $doctor)
                                        <tr>
                                            <td>
                                                <div class="d-flex ">

                                                    @if($doctor->picture != null)
                                                    <img src="{{asset('upload/'.$doctor->picture)}}" alt="">
                                                    @else
                                                    <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                        class="personal-avatar" alt="avatar" id="avatar-image">
                                                    @endif
                                                    <div>
                                                        <h6>{{$doctor->first_name}} {{$doctor->last_name}}</h6>

                                                        <p>Department:&nbsp;
                                                            @if($doctor->dept_id == 1)
                                                            Laboratory
                                                            @elseif($doctor->dept_id == 2)
                                                            Pharmacy
                                                            @elseif($doctor->dept_id == 3)
                                                            Radiology
                                                            @elseif($doctor->dept_id == 4)
                                                            Dialysis
                                                            @else
                                                            No Department
                                                            @endif</p>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p>{{$doctor->employee_id}}</p>
                                            </td>
                                            <td>
                                                <p>{{$doctor->email}}</p>
                                            </td>
                                            <td style="min-width:80px;">
                                                <p>{{$doctor->birth_date}}</p>
                                            </td>
                                            <td style="min-width:50px;">
                                                <p>{{$doctor->age}}</p>
                                            </td>
                                            <td>
                                                <p>{{$doctor->mobile}}</p>
                                            </td>
                                            <td style="min-width:80px;">
                                                <p>{{$doctor->gender}}</p>
                                            </td>
                                            <td style="min-width:80px;">
                                                <p>{{$doctor->isActivated == 1 ? 'Activated' : 'Deactivated' }}</p>
                                            </td>
                                            <td>

                                                <div class="d-flex">

                                                    @if($doctor->dept_id == 1 || $doctor->dept_id == 3 ||
                                                    $doctor->dept_id == 4)
                                                    <!-- <a href="{{route('doctor-time-schedules',$doctor->id)}}"
                                                        class="btn  btn-info fs-5 text-white p-2"><span class="iconify"
                                                            data-icon="lucide:calendar-clock"></span></a> -->
                                                    @else
                                                    @endif



                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#editstaff" data-id="{{ $doctor->id }}"
                                                        data-fname="{{ $doctor->first_name }}"
                                                        data-lname="{{ $doctor->last_name }}"
                                                        data-empid="{{ $doctor->employee_id }}"
                                                        data-email="{{ $doctor->email }}"
                                                        data-password="{{ $doctor->password }}"
                                                        data-picture="{{ $doctor->picture ?? '' }}"
                                                        data-bday="{{ $doctor->birth_date }}"
                                                        data-age="{{ $doctor->age }}"
                                                        data-mobile="{{ $doctor->mobile }}"
                                                        data-gender="{{ $doctor->gender }}"
                                                        data-department="{{ $doctor->dept_id }}"
                                                        class="btn  btn-dark fs-5 text-white p-2"><span class="iconify"
                                                            data-icon="tabler:edit"></span></a>

                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#removestaff" data-id="{{ $doctor->id }}"
                                                        class="btn  btn-danger fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="iwwa:trash"></span></a>

                                                    @if($doctor->isActivated == 1)

                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#deactivate" data-id="{{ $doctor->id }}"
                                                        class="btn  btn-warning fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="lucide:power-off"></span></a>

                                                    @else

                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#activate" data-id="{{ $doctor->id }}"
                                                        class="btn  btn-secondary fs-5 text-white p-2"><span
                                                            class="iconify"
                                                            data-icon="game-icons:power-button"></span></a>

                                                    @endif


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
        @elseif(Auth::user()->type == 2)
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">List of&nbsp;{{ $department_request->name
                                        }}&nbsp;Request</h4>
                                </div>


                                <button class="btn btn-dark btn-sm text-white p-2" data-bs-toggle="modal"
                                    data-bs-target="#maketicket"><span class="iconify fs-20"
                                        data-icon="emojione-v1:ticket"></span>&nbsp;Create Charge Ticket</button>




                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Ticket Number</th>
                                            <th>Patients</th>
                                            <!-- @if(Auth::user()->type == 2 && Auth::user()->dept_id == 2)
                                            <th>Medicine Name</th>
                                            <th>Medicine Category</th>
                                            @else
                                            <th>Item</th>
                                            <th>Item Category</th>
                                            @endif -->
                                            <th>Status</th>
                                            <th>Date Request</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient_requests as $pr)
                                        @php
                                        $sum = 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <p>{{$pr->ticket_number}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->firstname.' '.$pr->lastname}}</p>
                                            </td>
                                            <!-- @if(Auth::user()->type == 2 && Auth::user()->dept_id == 2)
                                            <td style="min-width:90px;">
                                                <p>{{$pr->medicine}}</p>
                                            </td>
                                            @else
                                            <td style="min-width:90px;">
                                                <p>{{$pr->test}}</p>
                                            </td>
                                            @endif -->
                                            <!-- <td  style="min-width:90px;">
                                                <p>{{$pr->name}}</p>
                                            </td> -->
                                            <td  style="min-width:90px;">
                                            <!-- {{$pr->ticket_status == 0 ? 'Pending' : 
                                            ($pr->ticket_status == 1 ? 'Awaiting Approval' :
                                            ($pr->ticket_status == 2 ? 'Disapproved' :
                                            ($pr->ticket_status == 3 ? 'Approved' :
                                            ($pr->ticket_status == 4 ? 'Complete' : 'Unknown Status'))))
                                            }} -->
                                            {{ $pr->ticket_status == 0 ? 'Pending' : 'Malasakit Approved Request' }}
                                            </td>
                                            <td>
                                                {{ $pr->created_at.' '.date('l',strtotime($pr->created_at))}}
                                            </td>
                                            <td>
                                                @if($pr->ticket_status == 0)
                                                <a href="{{ route('get-print_ticket',$pr->ticket_number)}}"
                                                    class="btn btn-success btn-sm p-2 text-white"><span class="iconify"
                                                        data-icon="fluent-emoji-high-contrast:printer"></span>&nbsp;Print
                                                    Charge Ticket</a>
                                                @else
                                                <a href="javascript:;" class="btn btn-success btn-sm p-2 text-white"
                                                    style="opacity:0.5;" data-toggle="tooltip"
                                                    title="Please check your approve tab"><span
                                                        class="iconify"
                                                        data-icon="fluent-emoji-high-contrast:printer"></span>&nbsp;Print
                                                    Charge Ticket</a>
                                                @endif
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



        @else
        <script>
            Swal.fire({
                title: "Intruder!",
                text: "You need to contact administrator to access this page.",
                icon: "warning",
                confirmButtonText: "OK",
                onOpen: function () {
                    var modalss = document.getElementsByClassName("swal-modal")[0];
                    modalss.style.backgroundColor = "rgba(0, 0, 0, 0)";
                }
            }).then(function () {
                document.getElementById('logout-form').submit();
            });

        </script>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        @endif





        <div class="modal fade" id="addstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:100%;max-width:45%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('doctors.store')}}" enctype="multipart/form-data"
                            id="addstaff-form-id">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Profile Avatar:</label>
                                        <div class="col-sm-8">
                                            <div class="personal-image">
                                                <label class="label">
                                                    <input type="file" id="image-input" name="picture"
                                                        value="{{ old('picture') }}" accept=".png, .jpg, .jpeg"
                                                        class="@error('picture') is-invalid @enderror image-input">
                                                    <figure class="personal-figure">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                            class="personal-avatar avatar-image" alt="avatar">
                                                        <figcaption class="personal-figcaption">
                                                            <img
                                                                src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                                        </figcaption>
                                                    </figure>
                                                </label>
                                            </div>
                                            @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label"
                                                style="position:relative;top:-10px;">Employee ID:</label>
                                            <div class="col-sm-8">
                                                <input id="add_employee_id"
                                                    class="form-control  @error('employee_id') is-invalid @enderror"
                                                    type="text" name="employee_id" value="{{ old('employee_id') }}"
                                                    required>
                                                @error('employee_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label"
                                                style="position:relative;top:-10px;">Firstname:</label>
                                            <div class="col-sm-8">
                                                <input id="first_name"
                                                    class="form-control  @error('first_name') is-invalid @enderror"
                                                    type="text" name="first_name" value="{{ old('first_name') }}"
                                                    placeholder="Enter Firstname" required>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label"
                                                style="position:relative;top:-10px;">Lastname:</label>
                                            <div class="col-sm-8">
                                                <input id="last_name"
                                                    class="form-control  @error('last_name') is-invalid @enderror"
                                                    type="text" name="last_name" value="{{ old('last_name') }}"
                                                    placeholder="Enter Lastname" required>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div><!-- End Col-6 -->


                                </div>


                                <div class="col-sm-6">

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Email Address:</label>
                                        <div class="col-sm-8">
                                            <input id="email" class="form-control  @error('email') is-invalid @enderror"
                                                type="text" name="email" value="{{ old('email') }}"
                                                placeholder="Enter Email Address" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Password:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="password"
                                                    class="form-control @error('password') is-invalid @enderror password-input"
                                                    type="text" name="password" placeholder="Enter Password" required>
                                                <div class="input-group-append generate-password">
                                                    <span class="input-group-text" style="height:33px;"><span
                                                            class="iconify"
                                                            data-icon="icon-park:click-tap"></span></span>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Birthdate:</label>
                                        <div class="col-sm-8">
                                            <input id="bdate"
                                                class="form-control  @error('birth_date') is-invalid @enderror"
                                                type="text" name="birth_date" value="{{ old('birth_date') }}"
                                                placeholder="Select BirthDate" required onchange="submitBday()">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Age:</label>
                                        <div class="col-sm-8">
                                            <input id="age" class="form-control  @error('age') is-invalid @enderror"
                                                type="number" readonly name="age" value="{{ old('age') }}"
                                                placeholder="Age" required>
                                            @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Gender:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control  @error('birth_date') is-invalid @enderror p-1"
                                                name="gender" id="gender" required>
                                                <option>Select Gender</option>
                                                <option value="male">male</option>
                                                <option value="female">female</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Mobile #:</label>
                                        <div class="col-sm-8">
                                            <input id="mobile"
                                                class="form-control  @error('mobile') is-invalid @enderror mobile-input"
                                                required type="tel" pattern="\+63\d{10}" name="mobile"
                                                placeholder="+63XXXXXXXXXX" value="{{ old('mobile') }}">

                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Departments:</label>
                                        <div class="col-sm-8">

                                            <select class="form-control @error('departments') is-invalid @enderror p-1"
                                                required name="departments" id="departments">
                                                <option selected disabled>-- Choose Department--</option>
                                                @foreach($departments as $department)
                                                <option value="{{$department->dep_id}}">
                                                    {{$department->name}}
                                                </option>
                                                @endforeach
                                            </select>


                                            @error('departments')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div><!-- End Col-6 -->

                            </div>

                    </div>
                    <div class="modal-footer p-3">
                        <button class="btn  btn-danger resetStaff">Cancel</button>
                        <button type="submit" class="btn btn-primary submitBtn">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:100%;max-width:45%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update-staff')}}" enctype="multipart/form-data"
                            id="editstaff-form-id">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="staff_id" id="staff_id">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Profile Avatar:</label>
                                        <div class="col-sm-8">
                                            <div class="personal-image">
                                                <label class="label">
                                                    <input type="file" name="picture" value="{{ old('picture') }}"
                                                        accept=".png, .jpg, .jpeg"
                                                        class="@error('picture') is-invalid @enderror image-input">
                                                    <figure class="personal-figure">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                            class="personal-avatar avatar-image" alt="avatar">

                                                        <!-- <span id="picture-edit"></span> -->

                                                        <figcaption class="personal-figcaption">
                                                            <img
                                                                src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                                        </figcaption>
                                                    </figure>
                                                </label>
                                            </div>
                                            @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label"
                                                style="position:relative;top:-10px;">Employee ID:</label>
                                            <div class="col-sm-8">
                                                <input id="employee_id"
                                                    class="form-control  @error('employee_id') is-invalid @enderror"
                                                    type="text" name="employee_id" value="{{ old('employee_id') }}"
                                                    required>
                                                @error('employee_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label"
                                                style="position:relative;top:-10px;">Firstname:</label>
                                            <div class="col-sm-8">
                                                <input id="first_name"
                                                    class="form-control  @error('first_name') is-invalid @enderror"
                                                    type="text" name="first_name" value="{{ old('first_name') }}"
                                                    placeholder="Enter Firstname" required>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label"
                                                style="position:relative;top:-10px;">Lastname:</label>
                                            <div class="col-sm-8">
                                                <input id="last_name"
                                                    class="form-control  @error('last_name') is-invalid @enderror"
                                                    type="text" name="last_name" value="{{ old('last_name') }}"
                                                    placeholder="Enter Lastname" required>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div><!-- End Col-6 -->


                                </div>


                                <div class="col-sm-6">

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Email Address:</label>
                                        <div class="col-sm-8">
                                            <input id="email" class="form-control  @error('email') is-invalid @enderror"
                                                type="text" name="email" value="{{ old('email') }}"
                                                placeholder="Enter Email Address" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Password:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="password"
                                                    class="form-control @error('password') is-invalid @enderror password-input"
                                                    type="text" name="password" placeholder="Enter Password" required>
                                                <div class="input-group-append generate-password">
                                                    <span class="input-group-text" style="height:33px;"><span
                                                            class="iconify"
                                                            data-icon="icon-park:click-tap"></span></span>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Birthdate:</label>
                                        <div class="col-sm-8">
                                            <input id="bdate_edit"
                                                class="form-control  @error('birth_date') is-invalid @enderror"
                                                type="text" name="birth_date" value="{{ old('birth_date') }}"
                                                placeholder="Select BirthDate" required onchange="submitBday_edit()">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Age:</label>
                                        <div class="col-sm-8">
                                            <input id="age_edit"
                                                class="form-control  @error('age') is-invalid @enderror" type="number"
                                                readonly name="age" value="{{ old('age') }}" placeholder="Age" required>
                                            @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Gender:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control   @error('birth_date') is-invalid @enderror p-1"
                                                name="gender" id="gender" required>
                                                <option>Select Gender</option>
                                                <option value="male">male</option>
                                                <option value="female">female</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Mobile #:</label>
                                        <div class="col-sm-8">
                                            <input id="mobile-edit"
                                                class="form-control  @error('mobile') is-invalid @enderror mobile-input"
                                                required type="tel" pattern="\+63\d{10}" name="mobile"
                                                placeholder="+63XXXXXXXXXX" value="{{ old('mobile') }}">

                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label"
                                            style="position:relative;top:-10px;">Departments:</label>
                                        <div class="col-sm-8">

                                            <select class="form-control @error('departments') is-invalid @enderror p-1"
                                                required name="departments" id="departments">
                                                <option selected disabled>-- Choose Department--</option>
                                                @foreach($departments as $department)
                                                <option value="{{$department->dep_id}}">
                                                    {{$department->name}}
                                                </option>
                                                @endforeach
                                            </select>


                                            @error('departments')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div><!-- End Col-6 -->

                            </div>

                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary submitBtn">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removestaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('destroy-staff') }}">
                            @method('DELETE')
                            @csrf
                            <center>
                                <input type="hidden" name="staff_id" id="remove_staff">
                                <h2 class="lead">Are you sure you want to remove this?</h2>
                                <small class=""><i>This will not recover anymore after you delete this
                                        record.</i></small><br><br>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Remove</button>
                            </center>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('deactivate-staff') }}">
                            @csrf
                            <center>
                                <input type="hidden" name="staff_id" id="staff_id">
                                <h2 class="lead">Do you want to deactivate this account?</h2>
                                <small class=""><i>This user will not be able to login.</i></small><br><br>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Deactivate</button>
                            </center>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="activate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('activate-staff') }}">
                            @csrf
                            <center>
                                <input type="hidden" name="staff_id" id="staff_id">
                                <h2 class="lead">Do you want to activate this account?</h2>
                                <small class=""><i>This user will not be blacklisted.</i></small><br><br>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Activate</button>
                            </center>

                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- USER SIDE -->
        <!-- <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            @if(Auth::user()->type == 2 && Auth::user()->dept_id == 3)
            <div class="modal-dialog" role="document" style="max-width:45%;">
                @else
                <div class="modal-dialog" role="document">
                    @endif
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Charge Ticket</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('ticket-generate') }}">
                                @csrf
                                @if(Auth::user()->type == 2 && Auth::user()->dept_id == 1 ||
                                Auth::user()->type == 2 && Auth::user()->dept_id == 2 ||
                                Auth::user()->type == 2 && Auth::user()->dept_id == 3 ||
                                Auth::user()->type == 2 && Auth::user()->dept_id == 4)
                                <input type="hidden" name="token" value="{{ $token }}">
                                @endif

                                <input value="{{ Auth::user()->dept_id }}" type="hidden" name="did">

                                <table class="border-0 w-100" id="service_table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control" name="test[]"
                                                    placeholder="Enter type of test" required>
                                            </td>

                                            @if(Auth::user()->type == 2 && Auth::user()->dept_id == 3)
                                            <td>
                                                <select class="form-control" name="type[]" required>
                                                    <option selected disabled>-- Select Radiology Type --</option>
                                                    <option value="X-ray">X-ray</option>
                                                    <option value="Ultrasound">Ultrasound</option>
                                                    <option value="CT-Scan">CT-Scan</option>
                                                </select>
                                            </td>
                                            @endif
                                            <td>
                                                @if(Auth::user()->type == 2 && Auth::user()->dept_id == 3)
                                                <input type="number" class="form-control amount-test"
                                                    oninput="calculateTestGrandTotal()" name="amount[]"
                                                    placeholder="Amount" required>
                                                @else
                                                <input type="number" class="form-control amount-test"
                                                    oninput="calculateTestGrandTotal()" name="amount[]"
                                                    placeholder="Amount" required
                                                    style="max-width:135px;margin-left:13px;">
                                                @endif
                                            </td>
                                            <td><button type="button" onclick="removeRows(this)"
                                                    class="btn btn-danger rounded-0 p-2"><span class="iconify fs-20"
                                                        data-icon="tabler:trash-x"></span></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <button type="button" onclick="addRows()"
                                        class="btn btn-dark btn-sm text-white rounded-0  mb-2 mt-2"> <span
                                            class="iconify fs-20"
                                            data-icon="material-symbols:library-add-outline"></span>&nbsp;Add
                                        Row</button>
                                </div>

                                <div style="float:right;position:relative;left:-13px;">
                                    <div id="grand-total-test"></div>
                                </div>

                        </div>
                        <div class="modal-footer p-3">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit Ticket</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="modal fade" id="maketicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width:45%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Charge Ticket</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('ticket-generate') }}" enctype="multipart/form-data">
                            @csrf
                            @if(Auth::user()->type == 2 && Auth::user()->dept_id == 1 ||
                            Auth::user()->type == 2 && Auth::user()->dept_id == 2 ||
                            Auth::user()->type == 2 && Auth::user()->dept_id == 3 ||
                            Auth::user()->type == 2 && Auth::user()->dept_id == 4)
                            <input type="hidden" name="token" value="{{ $token }}">
                            @endif


                            <h5 class="lead mb-4"><b>Patient Details:</b></h5>

                            <div class="form-group row mb-2">
                                <label for="inputRequest" class="col-sm-2 col-form-label"
                                    style="position:relative;top:-5px;">Upload Request:</label>
                                <div class="col-sm-10">
                                    <input type='file' id="scanfile"
                                        class="form-control  @error('scanfile') is-invalid @enderror" name="scanfile"
                                        value="{{ old('scanfile') }}" autocomplete="scanfile">
                                    <span class="text-danger" style="font-size:12px;"><i>scan the request on the scanner, browse the file and upload</i></span>
                                    @error('scanfile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-2 col-form-label"
                                    style="position:relative;top:-5px;">Firstname:</label>
                                <div class="col-sm-10">
                                    <input type='text' id="firstname"
                                        class="form-control  @error('firstname') is-invalid @enderror" name="firstname"
                                        value="{{ old('firstname') }}" autocomplete="firstname"
                                        placeholder="{{ __('Enter Firstname') }}">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-2 col-form-label"
                                    style="position:relative;top:-5px;">Lastname:</label>
                                <div class="col-sm-10">
                                    <input type='text' id="lastname"
                                        class="form-control  @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" autocomplete="lastname"
                                        placeholder="{{ __('Enter Lastname') }}">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-2 col-form-label"
                                    style="position:relative;top:-5px;">BirthDate:</label>
                                <div class="col-sm-10">
                                    <input type='text' id="bdate_patient" placeholder="Select Birthdate" onchange="submitBdayPatient()"
                                        class="form-control  @error('birthday') is-invalid @enderror" name="birthday"
                                        value="{{ old('birthday') }}" autocomplete="birthday">
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-2 col-form-label"
                                    style="position:relative;top:-5px;">Age:</label>
                                <div class="col-sm-10">
                                    <input type='number' id="age_patient" class="form-control" name="age" readonly autocomplete="age" placeholder="{{ __('Age') }}">

                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-2 col-form-label"
                                    style="position:relative;top:-5px;">Gender:</label>
                                <div class="col-sm-10">
                                    <select class="form-control  @error('gender') is-invalid @enderror" name="gender">
                                        <option selected disabled>-- Select Gender --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <h5 class="lead mt-3"><b>Ticket:</b></h5>

                            <input value="{{ Auth::user()->dept_id }}" type="hidden" name="did">


                            <table class="border-0 w-100" id="service_table_two">
                                <tbody>
                                    <tr>
                                        <td>
                                            @if(Auth::user()->type == 2 && Auth::user()->dept_id == 1)
                                            <select class="form-control" name="item[]" required
                                                onchange="updateAmount(this)">
                                                <option selected disabled>Select Laboratory</option>
                                                @foreach($laboratories as $laboratory)
                                                <option value="{{$laboratory->id}}"
                                                    data-amount="{{$laboratory->amount}}" data-category="{{$laboratory->name}}">{{$laboratory->test}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 2)
                                            <select class="form-control" name="item[]" required
                                                onchange="updateAmount(this)">
                                                <option selected disabled>Select Medicine</option>
                                                @foreach($medicines as $medicine)
                                                <option value="{{$medicine->pharma_id}}"
                                                    data-amount="{{$medicine->amount}}"  data-category="{{$medicine->name}}">{{$medicine->medicine}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 3)
                                            <select class="form-control" name="item[]" required
                                                onchange="updateAmount(this)">
                                                <option selected disabled>Select Radilogy</option>
                                                @foreach($radiologies as $radiology)
                                                <option value="{{$radiology->id}}"
                                                    data-amount="{{$radiology->amount}}"  data-category="{{$radiology->name}}">{{$radiology->test}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 4)
                                            <select class="form-control" name="item[]" required
                                                onchange="updateAmount(this)">
                                                <option selected disabled>Select Hemodialysis</option>
                                                @foreach($hemodialysis as $dialysis)
                                                <option value="{{$dialysis->id}}"
                                                    data-amount="{{$dialysis->amount}}"  data-category="{{$dialysis->name}}">{{$dialysis->test}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @else
                                            No Department yet
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" name="category" readonly class="form-control"placeholder="Category"
                                                required style="margin-left:13px;" ">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control qty" name="qty[]" placeholder="Qty"
                                                required style="margin-left:13px;" oninput="calculateGrandTotal()">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control amount" name="amount[]"
                                                placeholder="Amount" required style="margin-left:23px;" readonly>
                                        </td>
                                        <td><button type="button" onclick="removeRowstwo(this)"
                                                class="btn btn-danger rounded-0 p-2"><span class="iconify fs-20"
                                                    data-icon="tabler:trash-x"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex">
                                <button type="button" onclick="addRowstwo()"
                                    class="btn btn-dark btn-sm text-white rounded-0  mb-2 mt-2"> <span
                                        class="iconify fs-20"
                                        data-icon="material-symbols:library-add-outline"></span>&nbsp;Add
                                    Row</button>
                            </div>
                            <div style="float:right;position:relative;left:-13px;">
                                <div id="grand-total"></div>
                            </div>




                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- begin:: Content -->
        @endsection