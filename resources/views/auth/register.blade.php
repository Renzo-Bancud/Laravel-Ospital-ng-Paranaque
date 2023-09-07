@extends('layouts.auth')

@section('content')

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 dashed">
                            <div class="brand-logo">
                                <img src="../../images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! Patient</h4>
                            <h6 class="fw-light">Create your Account</h6>
                            <!-- <span style="position:relative;top:50px;left:10px;font-size:12px;"><b>Birthday</b></span> -->
                            <form class="pt-3" action="{{ route('register') }}" method="POST" style="margin-top:-10px;">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <input type='text' id="firstname" class="form-control  @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" placeholder="{{ __('Enter Firstname') }}">
                                            @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">

                                            <input type='text' id="bdate" placeholder="Select Birthdate"   onchange="submitBday()" class="form-control  @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" autocomplete="birthday">
                                            @error('birthday')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <input type='text' id="lastname" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" placeholder="{{ __('Enter Lastname') }}">
                                            @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <input type='number' id="age" class="form-control  @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" readonly autocomplete="age" placeholder="{{ __('Age') }}">
                                            @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>




                                    </div>
                                </div>


                                <div class="form-group">
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


                                <div class="form-group">
                                    <input type='text' id="address" class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" placeholder="{{ __('Enter Address') }}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <input type='text' id="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('Email Address') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" autocomplete="current-password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('Enter Password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" autocomplete="new-password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                                </div>


                                <div class="mt-3">


                                    <button type="submit" class="btn btn-block btn-primary p-3  font-weight-medium auth-form-btn">
                                        {{ __('Register') }}
                                    </button>



                                </div>


                                <div class="d-flex mt-3">
                                    <h6>Already have an account?</h6>
                                    &nbsp;
                                    <a href="{{ route('login') }}" style="position:relative;top:-3px;">Login</a>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @endsection