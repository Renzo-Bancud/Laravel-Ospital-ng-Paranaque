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
                            <h4>Reset Password</h4>

                            <h6 class="fw-light">Please fill out the fields to reset your password.</h6>

                            <form method="POST" action="{{ route('password.update') }}" class="pt-3">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <input required='' type='email' id="email" class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" placeholder="Email Address">
                                    <label placeholder="{{ __('E-Mail Address') }}"></label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input required='' id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Enter New Password">
                                    <label placeholder="{{ __('Password') }}"></label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <input required='' id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" autocomplete="new-password" placeholder="Re-Type Password">
                                    <label placeholder="{{ __('Confirm Password') }}"></label>

                                </div>


                                <div class="mt-3">


                                    <button type="submit" class="btn btn-block btn-primary  font-weight-medium auth-form-btn">
                                        {{ __('Reset Password') }}
                                    </button>



                                </div>
                                <div class="my-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        Already have an account?
                                    </div>
                                    @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="auth-link text-black"> {{ __('Sign In Account') }}</a>
                                    @endif

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