@extends('layouts.dashboard')

@section('content')

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
                                    <h4 class="card-title card-title-dash">Manage PPP accounts</h4>
                                    <p class="card-subtitle card-subtitle-dash">List of created PPP accounts</p>
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

                                    @if(count($accountants) > 0)
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
                                        @forelse($accountants as $accountant)
                                        <tr>
                                            <td>
                                                <div class="d-flex">

                                                    @if($accountant->picture != null)
                                                    <img src="{{asset('upload/'.$accountant->picture)}}" alt="">
                                                    @else
                                                    <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                            class="personal-avatar" alt="avatar" id="avatar-image">
                                                    @endif
                                                    <div>
                                                        <h6>{{$accountant->first_name}} {{$accountant->last_name}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><p>{{$accountant->employee_id}}</p></td>
                                            <td><p>{{$accountant->email}}</p></td>
                                            <td  style="min-width:80px;"><p>{{$accountant->birth_date}}</p>
                                            </td><td style="min-width:50px;"><p>{{$accountant->age}}</p></td>
                                            <td><p>{{$accountant->mobile}}</p></td>
                                            <td style="min-width:80px;"><p>{{$accountant->gender}}</p></td>
                                            <td style="min-width:80px;">
                                                <p>{{$accountant->isActivated == 1 ? 'Activated' : 'Deactivated' }}</p>
                                            </td>
                                            <td>

                                                <div class="d-flex">
                                                    <a href="javascript:;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editstaff"
                                                    data-id="{{ $accountant->id }}"
                                                    data-fname="{{ $accountant->first_name }}"
                                                    data-lname="{{ $accountant->last_name }}"
                                                    data-empid="{{ $accountant->employee_id }}"
                                                    data-email="{{ $accountant->email }}"
                                                    data-password="{{ $accountant->password }}"
                                                    data-picture="{{ $accountant->picture ?? '' }}"

                                                    data-bday="{{ $accountant->birth_date }}"
                                                    data-age="{{ $accountant->age }}"
                                                    data-mobile="{{ $accountant->mobile }}"
                                                    data-gender="{{ $accountant->gender }}"
                                                    data-department="{{ $accountant->dept_id }}"

                                                        class="btn  btn-dark fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="tabler:edit"></span></a>

                                                    <a href="javascript:;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#removestaff" data-id="{{ $accountant->id }}"
                                                        class="btn  btn-danger fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="iwwa:trash"></span></a>

                                                    @if($accountant->isActivated == 1)

                                                    <a href="javascript:;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deactivate" data-id="{{ $accountant->id }}"
                                                        class="btn  btn-warning fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="lucide:power-off"></span></a>

                                                    @else

                                                    <a href="javascript:;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#activate" data-id="{{ $accountant->id }}"
                                                        class="btn  btn-secondary fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="game-icons:power-button"></span></a>

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

        @elseif(Auth::user()->type == 5)

        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                <div class="card card-rounded" style="border:1px black dashed;">
            <div class="card-body">
              <div class="d-sm-flex justify-content-between align-items-start">
                <div>
                  <h4 class="card-title card-title-dash">Approved Request</h4>
                  
                </div>
              </div>
              <div class="mt-1">

              <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Ticket Number</th>
                                            <th>Department</th>
                                            <th>Patient</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Fund Type</th>
                                            <th>Request Status</th>
                                            <th>Date Request</th>
                                         

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patients as $pr)

                                        <tr>
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
                                            <td style="width:100px;">
                                                <p>{{$pr->age }}</p>
                                            </td>
                                            <td  style="width:100px;">
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
                                            {{ $pr->request_status == 3 ? 'Approved' : '' }}
                                            </td>

                                            <td style="max-width:180px;">
                                                {{ $pr->date_request.' '.date('l',strtotime($pr->date_request))}}
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

        <!-- begin:: Content -->



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
                        <form method="POST" action="{{ route('accountants.store')}}" enctype="multipart/form-data" id="addstaff-form-id">
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
                                                    <figure class="personal-figure-malasakit">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                            class="personal-avatar-malasakit avatar-image" alt="avatar">
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
                                                class="form-control  @error('mobile') is-invalid @enderror mobile-input" required
                                                type="tel" pattern="\+63\d{10}" name="mobile"
                                                placeholder="+63XXXXXXXXXX" value="{{ old('mobile') }}">

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
                        <button  class="btn  btn-danger resetStaff">Cancel</button>
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
                        <form method="POST" action="{{ route('update-ppp-staff')}}" enctype="multipart/form-data" id="editstaff-form-id">
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
                                                    <input type="file"  name="picture"
                                                        value="{{ old('picture') }}" accept=".png, .jpg, .jpeg"
                                                        class="@error('picture') is-invalid @enderror image-input">
                                                    <figure class="personal-figure-malasakit">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                            class="personal-avatar-malasakit avatar-image" alt="avatar">
                                                            
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
                                            <input id="age_edit" class="form-control  @error('age') is-invalid @enderror"
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
                                                class="form-control  @error('mobile') is-invalid @enderror mobile-input" required
                                                type="tel" pattern="\+63\d{10}" name="mobile"
                                                placeholder="+63XXXXXXXXXX" value="{{ old('mobile') }}">

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
                        <button  type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"  class="btn btn-primary submitBtn">Save</button>
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
                        <form method="POST" action="{{ route('destroy-ppp-staff') }}">
                        @method('DELETE')
                        @csrf
                        <center>
                        <input type="hidden"  name="staff_id" id="remove_staff">
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

        <div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('deactivate-ppp-staff') }}">
                        @csrf
                        <center>
                        <input type="hidden"  name="staff_id" id="staff_id">
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
                        <form method="POST" action="{{ route('activate-ppp-staff') }}">
                        @csrf
                        <center>
                        <input type="hidden"  name="staff_id" id="staff_id">
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



    

    
        @endsection