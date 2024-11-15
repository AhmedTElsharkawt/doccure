@extends('layouts.doctor')

@section('title', 'Patient Dashboard')

@section('login/logout')
    <div  aria-labelledby="navbarDropdown">
        <a class="dropdown-item btn btn-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endsection

@section('breadcrump')
                <!-- Breadcrumb -->
                <div class="breadcrumb-bar">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-12">
                                <nav aria-label="breadcrumb" class="page-breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                    </ol>
                                </nav>
                                <h2 class="breadcrumb-title">Change Password</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
@endsection


@section('content')
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">

						<!-- Profile Sidebar -->
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="{{ asset(Auth::user()->image) }}" target="_blanck"class="booking-doc-img">
											<img src="{{ asset(Auth::user()->image) }}" alt="User Image">
										</a>
                                        <div class="profile-det-info">
											<h3>{{ Auth::user()->name }}</h3>
											<div class="patient-details">
												<h5><i class="fas fa-birthday-cake"></i> {{ Auth::user()->date_of_birth . ", " . $age . " Years"}}</h5>
												<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ Auth::user()->country }}</h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="{{ route('index') }}">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li>
												<a href="{{ route('show.doctors') }}">
													<i class="fas fa-user-md"></i>
													<span>Doctors</span>
												</a>
											</li>
											<li>
												<a href="{{ route('patient.edit', Auth::user()->id) }}">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
											</li>
										</ul>
									</nav>
								</div>

							</div>
						</div>
						<!-- / Profile Sidebar -->

						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-6">

											<!-- Change Password Form -->
											<form action="{{ route('update.patient.password') }}" method="post">
                                                @csrf
                                                @method('put')

												<div class="form-group">
													<label>Old Password</label>
													<input name="old_password" type="password" class="form-control" required>

                                                    @error('old_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
												</div>
												<div class="form-group">
													<label>New Password</label>
													<input name="new_password" type="password" class="form-control" required>

                                                    @error('new_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input name="confirm_password" type="password" class="form-control" required>

                                                    @error('confirm_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
												</div>
											</form>
											<!-- /Change Password Form -->

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<!-- /Page Content -->
@endsection

