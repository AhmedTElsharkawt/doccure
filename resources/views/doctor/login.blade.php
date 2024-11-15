@extends('layouts.doctor')

@section('title', 'Doctor Login')

@push('body')
class="account-page"
@endpush

@section('content')
            <!-- Page Content -->
			<div class="content" >
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-8 offset-md-2">

							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="{{ asset('assets/img/login-banner.png') }}" class="img-fluid" alt="Doccure Login">
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3><strong>DOCTOR LOGIN</strong> <a href="{{ route('login') }}">Not a Doctor?</a></h3>
										</div>
										<form method="POST" action="{{ route('doctor.dologin') }}">
                                            @csrf

											<div class="form-group form-focus">
												<input name="email" type="email" class="form-control floating" value="{{ old('email') }}" required autocomplete="email" autofocus>
												<label class="focus-label">Email</label>

                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
											</div>
											<div class="form-group form-focus">
												<input name="password" type="password" class="form-control floating" required autocomplete="current-password">
												<label class="focus-label">Password</label>

                                                @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
											</div>

											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>


											<div class="text-center dont-have">Don’t have an account? <a href="{{ route('doctor.register') }}">Register</a></div>
										</form>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->
@endsection
