@extends('layouts.doctor')

@section('title', 'Patient Register')

@push('body')
class="account-page"
@endpush

@section('content')
        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Account Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="{{ asset('assets/img/login-banner.png') }}" class="img-fluid" alt="Login Banner">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3><strong>PATIENT REGISTER</strong> <a href="{{ route('doctor.doregister') }}">Not a Patient?</a></h3>
                                    </div>

                                    <!-- Register Form -->
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group form-focus">
                                            <input name="name" type="text" class="form-control floating" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            <label class="focus-label">Name</label>

                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group form-focus">
                                            <input name="email" type="email" class="form-control floating" value="{{ old('email') }}" required autocomplete="email">
                                            <label class="focus-label">Email Address</label>

                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group form-focus">
                                            <input name="password" type="password" class="form-control floating"  required autocomplete="new-password">
                                            <label class="focus-label">Create Password</label>

                                            @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group form-focus">
                                            <input name="password_confirmation" type="password" class="form-control floating"  required autocomplete="new-password">
                                            <label class="focus-label">Confirm Password</label>

                                            @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="text-right">
                                            <a class="forgot-link" href="{{ route('login') }}">Already have an account?</a>
                                        </div>
                                        <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>

                                    </form>
                                    <!-- /Register Form -->

                                </div>
                            </div>
                        </div>
                        <!-- /Account Content -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection
