@extends('layouts.auth')

<div id="particles-js"></div>
@section('content')
<div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card border-0" style="background:transparent;margin-top:150px;">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-3 d-none d-lg-inline-block"></div>
                        <div class="col-lg-6">
                            <div class="p-3">
                                <div class="mb-3">
                                    <h3 class="h1 font-weight-bolder text-theme text-center">Farm-Venture</h3>
                                </div>

                                <div class="mt-2 mb-4 text-center">
                                    <p class="text-muted"> {{ __('Please confirm your password before continuing.') }}</p>
                                </div>

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf


                                    <div class="form-group has-success">
                                        <input required='' id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                        <label placeholder="{{ __('Password') }}"></label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>




                                    <button type="submit" class="btn btn-primary mt-3 form-control">
                                        {{ __('Confirm Password') }}
                                    </button>

                                </form>


                            </div>
                        </div>

                        <div class="col-lg-3 d-none d-lg-inline-block"></div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

            <p class="text-muted text-center mt-0 mb-0">
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </p>



            <!-- end row -->

        </div>
        <!-- end col -->
    </div>
    <!-- Row -->
</div>
@endsection