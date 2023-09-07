@extends('layouts.auth')

@section('content')

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 dashed">
                            <div class="brand-logo text-center">
                                <img src="{{ asset('logo/logo.jpg') }}" alt="logo" height="100" width="810">
                                <h4 class="mt-2">Ospital ng Parañaque</h4>
                                <h6 class="fw-light text-center">Sign in to start your session:</h6>
                            </div>
                          
                           
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type='text' id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('Email Address') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" autocomplete="current-password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{ __('Password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-3">


                                    <button type="submit" class="btn btn-block btn-primary  font-weight-medium auth-form-btn">
                                        {{ __('Login') }}
                                    </button>



                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="remember" id="remember class=" form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Keep me signed in') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="auth-link text-black"> {{ __('Forgot Password?') }}</a>
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