@extends('layouts.dashboard')

@section('content')

<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- begin:: Content -->
        @if(Auth::user()->type == 1)
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Malasakit Staff</h4>
                                    <p class="card-subtitle card-subtitle-dash">List of created receptionists</p>
                                </div>
                                <div>

                                    <!-- <a href="{{route('receptionists.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0">
                    <span class="iconify fs-20 text-white" data-icon="medical-icon:i-care-staff-area"></span>&nbsp;Add Staff</a> -->

                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addstaff" id="add-staff-modal" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-account-plus"></i>Add Staff</a>

                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>

                                    @if(count($malasakits) > 0)
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
                                        </tr>
                                    @else

                                    @endempty

                                       
                                    </thead>
                                    <tbody>
                                        @forelse($malasakits as $malasakit)
                                        <tr>
                                            <td>
                                                <div class="d-flex">

                                                    @if($malasakit->picture != null)
                                                    <img src="{{asset('upload/'.$malasakit->picture)}}" alt="">
                                                    @else
                                                    <img src="https://imagetolink.com/ib/zZEA6whofk.png" class="personal-avatar" alt="avatar" id="avatar-image">
                                                    @endif
                                                    <div>
                                                        <h6>{{$malasakit->first_name}} {{$malasakit->last_name}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p>{{$malasakit->employee_id}}</p>
                                            </td>
                                            <td>
                                                <p>{{$malasakit->email}}</p>
                                            </td>
                                            <td style="min-width:80px;">
                                                <p>{{$malasakit->birth_date}}</p>
                                            </td>
                                            <td style="min-width:50px;">
                                                <p>{{$malasakit->age}}</p>
                                            </td>
                                            <td>
                                                <p>{{$malasakit->mobile}}</p>
                                            </td>
                                            <td style="min-width:80px;">
                                                <p>{{$malasakit->gender}}</p>
                                            </td>
                                            <td style="min-width:80px;">
                                                <p>{{$malasakit->isActivated == 1 ? 'Activated' : 'Deactivated' }}</p>
                                            </td>
                                            <td>

                                                <div class="d-flex">
                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editstaff" data-id="{{ $malasakit->id }}" data-fname="{{ $malasakit->first_name }}" data-lname="{{ $malasakit->last_name }}" data-empid="{{ $malasakit->employee_id }}" data-email="{{ $malasakit->email }}" data-password="{{ $malasakit->password }}" data-picture="{{ $malasakit->picture ?? '' }}" data-bday="{{ $malasakit->birth_date }}" data-age="{{ $malasakit->age }}" data-mobile="{{ $malasakit->mobile }}" data-gender="{{ $malasakit->gender }}" data-department="{{ $malasakit->dept_id }}" class="btn  btn-dark fs-5 text-white p-2"><span class="iconify" data-icon="tabler:edit"></span></a>

                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#removestaff" data-id="{{ $malasakit->id }}" class="btn  btn-danger fs-5 text-white p-2"><span class="iconify" data-icon="iwwa:trash"></span></a>

                                                    @if($malasakit->isActivated == 1)

                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#deactivate" data-id="{{ $malasakit->id }}" class="btn  btn-warning fs-5 text-white p-2"><span class="iconify" data-icon="lucide:power-off"></span></a>

                                                    @else

                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#activate" data-id="{{ $malasakit->id }}" class="btn  btn-secondary fs-5 text-white p-2"><span class="iconify" data-icon="game-icons:power-button"></span></a>

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
        @elseif(Auth::user()->type == 8)
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Patient's Request</h4>
                                </div>

                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Upload ID</th>
                                            <th>Ticket Number</th>
                                            <th>Department</th>
                                            <th>Patient</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Fund Type</th>
                                            <th>Request Status</th>
                                            <th>Signature</th>
                                            <th>Date Request</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient_requests as $pr)

                                        <tr>
                                              <td>
                                               @if($pr->upload_id == null)
                                                No uploaded ID yet
                                               @else
                                               <img src="{{asset('upload/'.$pr->upload_id)}}" alt="" style="min-width:150px;min-height:150px;">

                                               @endif
                                            </td>

                                            <td>
                                                <p>{{$pr->patient_ticket}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->name}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->firstname.' '.$pr->lastname}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->bday}}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->age }}</p>
                                            </td>
                                            <td>
                                                <p>{{$pr->gender }}</p>
                                            </td>

                                            <td>
                                                <p>{{$pr->address == null ? 'No specified address' : $pr->address }}</p>
                                            </td>

                                            <td>
                                                <p>{{$pr->fund_type == null ? 'No specified fund' : $pr->fund_type  }}</p>
                                            </td>

                                            <td style="width:150px;">
                                            <!-- {{$pr->request_status == 0 ? 'Pending' : 
                                            ($pr->request_status == 1 ? 'Awaiting Approval' :
                                            ($pr->request_status == 2 ? 'Disapproved' :
                                            ($pr->request_status == 3 ? 'Approved' :
                                            ($pr->request_status == 4 ? 'Complete' : 'Unknown Status'))))
                                            }} -->
                                            {{ $pr->request_status == null ? 'Pending' : 'Approved' }}
                                            </td>

                                            <td>
                                               @if($pr->patient_signature == null)
                                                No signature yet
                                               @else
                                               <img src="{{asset('upload/'.$pr->patient_signature)}}" alt="" style="min-width:150px;min-height:150px;">

                                               @endif
                                            </td>


                                            <td style="max-width:180px;">
                                                {{ $pr->date_request.' '.date('l',strtotime($pr->date_request))}}
                                            </td>
                                            <td>

                                                <div class="btn-group">
                                                    <button type="button" class="text-white btn btn-danger dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Choose Action
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @if($pr->address == null && $pr->fund_type == null && $pr->upload_id == null && $pr->patient_signature == null)

                                                        <li>
                                                            <a href="javascript:;" data-toggle="tooltip" style="background:silver;opacity:0.5;"
                                                            title="Please edit patient address and type of fund first to unlock this link" class="dropdown-item">
                                                                <span class="iconify fs-20" data-icon="flat-color-icons:print"></span>&nbsp;<span style="font-size:12px;">Print Form</span></a>
                                                        </li>

                                                        <li>
                                                            <a href="javascript:;"  style="background:silver;opacity:0.5;"
                                                            data-toggle="tooltip" 
                                                            title="Please edit patient address and type of fund first to unlock this link"
                                                            class="dropdown-item">
                                                                <span class="iconify fs-20" data-icon="fxemoji:printericon"></span>&nbsp;<span style="font-size:12px;">Print Hospital No.</span></a>
                                                        </li>

                                                        <li> <a href="javascript:;" style="background:silver;opacity:0.5;"
                                                        data-toggle="tooltip" 
                                                            title="Please edit patient address and type of fund first to unlock this link"
                                                        class="dropdown-item"><span class="iconify fs-20" data-icon="emojione-v1:newspaper"></span>&nbsp;<span style="font-size:12px;">Approve</span></a></li>
                                                        <li>

                                                            <hr class="dropdown-divider">
                                                        </li>


                                                        @else
                                                        <li>
                                                            <a href="{{ route('print_patient_malasakit',[ $pr->patient_ticket, $pr->pid ]) }}" class="dropdown-item">
                                                                <span class="iconify fs-20" data-icon="flat-color-icons:print"></span>&nbsp;<span style="font-size:12px;">Print Form</span></a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('print_identification_card', $pr->pid) }}" class="dropdown-item">
                                                                <span class="iconify fs-20" data-icon="fxemoji:printericon"></span>&nbsp;<span style="font-size:12px;">Print Hospital No.</span></a>
                                                        </li>


                                                        <li> <a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#approve_patientrequest" data-pid="{{ $pr->pid }}" data-ticket="{{ $pr->patient_ticket }}"><span class="iconify fs-20" data-icon="emojione-v1:newspaper"></span>&nbsp;<span style="font-size:12px;">Approve</span></a></li>
                                                       
                                                       
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                         
                                                        @endif
                                                        <li> <a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editpatient" 
                                                        data-pid="{{ $pr->pid }}" 
                                                        data-ticket="{{ $pr->patient_ticket }}" data-fname="{{ $pr->firstname }}" data-lname="{{ $pr->lastname }}" data-bdate="{{ $pr->bday }}" data-age="{{ $pr->age }}" data-gender="{{ $pr->gender }}"
                                                        data-address="{{ $pr->address }}" data-fundtype="{{ $pr->fund_type }}"
                                                        >
                                                                <span class="iconify fs-15" data-icon="fa:edit"></span>&nbsp;<span style="font-size:12px;">Edit Patient</span></a>
                                                        </li>

                                                        <!-- <li><a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forapproval"
                             data-pid="{{ $pr->id }}"><span class="iconify fs-20" data-icon="wpf:delete"></span>&nbsp;<span style="font-size:12px;">Delete</span></a></li> -->

                                                    </ul>
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

        @else
        <script>
            Swal.fire({
                title: "Intruder!",
                text: "You need to contact administrator to access this page.",
                icon: "warning",
                confirmButtonText: "OK",
                onOpen: function() {
                    var modalss = document.getElementsByClassName("swal-modal")[0];
                    modalss.style.backgroundColor = "rgba(0, 0, 0, 0)";
                }
            }).then(function() {
                document.getElementById('logout-form').submit();
            });
        </script>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endif




        <div class="modal fade" id="addstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:100%;max-width:45%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('receptionists.store')}}" enctype="multipart/form-data" id="addstaff-form-id">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Profile Avatar:</label>
                                        <div class="col-sm-8">
                                            <div class="personal-image">
                                                <label class="label">
                                                    <input type="file" id="image-input" name="picture" value="{{ old('picture') }}" accept=".png, .jpg, .jpeg" class="@error('picture') is-invalid @enderror image-input">
                                                    <figure class="personal-figure-malasakit">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png" class="personal-avatar-malasakit avatar-image" alt="avatar">
                                                        <figcaption class="personal-figcaption">
                                                            <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
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
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Employee ID:</label>
                                            <div class="col-sm-8">
                                                <input id="add_employee_id" class="form-control  @error('employee_id') is-invalid @enderror" type="text" name="employee_id" value="{{ old('employee_id') }}" required>
                                                @error('employee_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Firstname:</label>
                                            <div class="col-sm-8">
                                                <input id="first_name" class="form-control  @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter Firstname" required>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Lastname:</label>
                                            <div class="col-sm-8">
                                                <input id="last_name" class="form-control  @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Lastname" required>
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
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Email Address:</label>
                                        <div class="col-sm-8">
                                            <input id="email" class="form-control  @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Password:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="password" class="form-control @error('password') is-invalid @enderror password-input" type="text" name="password" placeholder="Enter Password" required>
                                                <div class="input-group-append generate-password">
                                                    <span class="input-group-text" style="height:33px;"><span class="iconify" data-icon="icon-park:click-tap"></span></span>
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
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Birthdate:</label>
                                        <div class="col-sm-8">
                                            <input id="bdate" class="form-control  @error('birth_date') is-invalid @enderror" type="text" name="birth_date" value="{{ old('birth_date') }}" placeholder="Select BirthDate" required onchange="submitBday()">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Age:</label>
                                        <div class="col-sm-8">
                                            <input id="age" class="form-control  @error('age') is-invalid @enderror" type="number" readonly name="age" value="{{ old('age') }}" placeholder="Age" required>
                                            @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Gender:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control  @error('birth_date') is-invalid @enderror p-1" name="gender" id="gender" required>
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
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Mobile #:</label>
                                        <div class="col-sm-8">
                                            <input id="mobile" class="form-control  @error('mobile') is-invalid @enderror mobile-input" required type="tel" pattern="\+63\d{10}" name="mobile" placeholder="+63XXXXXXXXXX" value="{{ old('mobile') }}">

                                            @error('mobile')
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


        <div class="modal fade" id="editstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:100%;max-width:45%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update-malasakit-staff')}}" enctype="multipart/form-data" id="editstaff-form-id">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="staff_id" id="staff_id">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Profile Avatar:</label>
                                        <div class="col-sm-8">
                                            <div class="personal-image">
                                                <label class="label">
                                                    <input type="file" name="picture" value="{{ old('picture') }}" accept=".png, .jpg, .jpeg" class="@error('picture') is-invalid @enderror image-input">
                                                    <figure class="personal-figure-malasakit">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png" class="personal-avatar-malasakit avatar-image" alt="avatar">

                                                        <!-- <span id="picture-edit"></span> -->

                                                        <figcaption class="personal-figcaption">
                                                            <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
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
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Employee ID:</label>
                                            <div class="col-sm-8">
                                                <input id="employee_id" class="form-control  @error('employee_id') is-invalid @enderror" type="text" name="employee_id" value="{{ old('employee_id') }}" required>
                                                @error('employee_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Firstname:</label>
                                            <div class="col-sm-8">
                                                <input id="first_name" class="form-control  @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter Firstname" required>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Lastname:</label>
                                            <div class="col-sm-8">
                                                <input id="last_name" class="form-control  @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Lastname" required>
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
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Email Address:</label>
                                        <div class="col-sm-8">
                                            <input id="email" class="form-control  @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Password:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="password" class="form-control @error('password') is-invalid @enderror password-input" type="text" name="password" placeholder="Enter Password" required>
                                                <div class="input-group-append generate-password">
                                                    <span class="input-group-text" style="height:33px;"><span class="iconify" data-icon="icon-park:click-tap"></span></span>
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
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Birthdate:</label>
                                        <div class="col-sm-8">
                                            <input id="bdate_edit" class="form-control  @error('birth_date') is-invalid @enderror" type="text" name="birth_date" value="{{ old('birth_date') }}" placeholder="Select BirthDate" required onchange="submitBday_edit()">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Age:</label>
                                        <div class="col-sm-8">
                                            <input id="age_edit" class="form-control  @error('age') is-invalid @enderror" type="number" readonly name="age" value="{{ old('age') }}" placeholder="Age" required>
                                            @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row" style="margin-bottom:-3px;">
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Gender:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control   @error('birth_date') is-invalid @enderror p-1" name="gender" id="gender" required>
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
                                        <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Mobile #:</label>
                                        <div class="col-sm-8">
                                            <input id="mobile-edit" class="form-control  @error('mobile') is-invalid @enderror mobile-input" required type="tel" pattern="\+63\d{10}" name="mobile" placeholder="+63XXXXXXXXXX" value="{{ old('mobile') }}">

                                            @error('mobile')
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

        <div class="modal fade" id="removestaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('destroy-malasakit-staff') }}">
                            @method('DELETE')
                            @csrf
                            <center>
                                <input type="hidden" name="staff_id" id="remove_staff">
                                <h2 class="lead">Are you sure you want to remove this?</h2>
                                <small class=""><i>This will not recover anymore after you delete this record.</i></small><br><br>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Remove</button>
                            </center>

                        </form>
                    </div>

                </div>
            </div>
        </div>



        <div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('deactivate-malasakit-staff') }}">
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

        <div class="modal fade" id="activate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('activate-malasakit-staff') }}">
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



        <div class="modal fade" id="editpatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document" style="margin-top:-120px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Edit Patient</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('edit-patient') }}" enctype="multipart/form-data" id="editpatient_form">
                            @csrf

                            <input type="hidden" id="pid" name="pid">

                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Firstname:</label>
                                <div class="col-sm-8">
                                    <input type='text' id="fname" required class="form-control  @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" placeholder="{{ __('Enter Firstname') }}">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Lastname:</label>
                                <div class="col-sm-8">
                                    <input type='text' required id="lname" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" placeholder="{{ __('Enter Lastname') }}">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Birth Date:</label>
                                <div class="col-sm-8">
                                    <input type="text" required id="bdate_update" placeholder="Select Birthdate" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" autocomplete="birthday">
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Age:</label>
                                <div class="col-sm-8">
                                    <input type='number' required id="age_update" class="form-control
                  " name="age" readonly autocomplete="age" placeholder="{{ __('Age') }}">

                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" id="gender" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Gender:</label>
                                <div class="col-sm-8">
                                    <select required class="form-control  @error('gender') is-invalid @enderror p-1" name="gender">
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


                            <div class="form-group row mb-1">
                                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Address:</label>
                                <div class="col-sm-8">
                                    <input type='text' id="address" required class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" placeholder="{{ __('Enter Address') }}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="inputRequest" id="gender" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Fund Type:</label>
                                <div class="col-sm-8">
                                    <select required id="fundtype" class="form-control  @error('fund_type') is-invalid @enderror p-1" name="fund_type">
                                        <option selected disabled>-- Select Fund Type --</option>
                                        <option value="OMOE">OMOE</option>
                                        <option value="DOH-MAIP">DOH-MAIP</option>
                                        <option value="PCSO">PCSO</option>
                                        <option value="OP-SCPF">OP-SCPF</option>
                                    </select>
                                    @error('fund_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-5px;">Upload ID:</label>
                                <div class="col-sm-8">
                                    <input type='file' id="scanfile"
                                        class="form-control  @error('scanfile') is-invalid @enderror" name="scanfile"
                                        value="{{ old('scanfile') }}" autocomplete="scanfile" required>
                                    <span class="text-danger" style="font-size:12px;"><i>scan ID on the scanner, browse the file and upload</i></span>
                                    @error('scanfile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                             
                            <div class="col-md-12">
                            <label class="" for="">Draw Signature:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br><br>
                            <button id="clear" class="btn btn-danger">Clear Signature</button>
                            <!-- <button class="btn btn-success">Save</button> -->
                            <textarea id="signature" name="signed" style="display: none"></textarea>
                        </div>



                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

       
    <div class="modal fade" id="approve_patientrequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header border-0 p-0">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close mt-2" style="position:relative;left:-15px;" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-2">
            <form method="POST" action="{{ route('approve_request') }}">
              @csrf

              <input id="pid" type="hidden" name="pid">
              <input id="ticket" type="hidden" name="ticket">


              <h2 class="lead text-center">Send approve request to Department Office?</h2>
              <div class="d-flex justify-content-center mt-3 mb-3">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>&nbsp;
                <button type="submit" class="btn btn-primary">Yes</button>
              </div>

            </form>

          </div>

        </div>
      </div>
    </div>
@endsection