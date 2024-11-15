@extends('layouts.doctor')

@section('title', 'Appointments')

@section('breadcrump')
                <!-- Breadcrumb -->
                <div class="breadcrumb-bar">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-12">
                                <nav aria-label="breadcrumb" class="page-breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('doctor.home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                                    </ol>
                                </nav>
                                <h2 class="breadcrumb-title">Appointments</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Breadcrumb -->
@endsection

@section('login/logout')
    <a href="{{ route('doctor.logout') }}" class="btn btn-danger">Logout</a>
@endsection

@section('content')
    			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

							<!-- Profile Sidebar -->
							<div class="profile-sidebar">
                                <div class="widget-profile pro-widget-content">
                                    <div class="profile-info-widget">
                                        <a href="{{ asset(Auth::guard('doctors')->user()->image) }}" class="booking-doc-img">
                                            <img src="{{ asset(Auth::guard('doctors')->user()->image) }}" alt="User Image">
                                        </a>
                                        <div class="profile-det-info">
                                            <h3>{{Auth::guard('doctors')->user()->name}}</h3>

                                            <div class="patient-details">
                                                <h5 class="mb-0">{{"Dr. " . Auth::guard('doctors')->user()->bio}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="{{ route('doctor.home', $doctorId) }}">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
                                            <li>
												<a href="{{ route('edit.doctor.password') }}">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
												</a>
											</li>
                                            <li>
                                                <a href="{{ route('doctor.edit', $doctorId) }}">
                                                    <i class="fas fa-user-cog"></i>
                                                    <span>Profile Settings</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ route('doctor.logout') }}">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
										</ul>
									</nav>
								</div>
							</div>
							<!-- /Profile Sidebar -->

						</div>
                        @if ($status == 'confirmed')
                            @if (!count($appointments) < 1)
                            <div class="col-md-7 col-lg-8 col-xl-9">
                                <h2 class="text-center my-3">Accepted Appoinments</h2>
                                <div class="appointments">
                                    <!-- Appointment List -->
                                    @foreach ( $appointments as $appointment )
                                    <div class="appointment-list">
                                        <div class="profile-info-widget">
                                            <a href="{{ asset($appointment->patient->image) }}" target="_blanck" class="booking-doc-img">
                                                <img src="{{ asset($appointment->patient->image) }}" alt="User Image">
                                            </a>
                                            <div class="profile-det-info">
                                                <h3>{{ $appointment->patient->name }}</h3>
                                                <div class="patient-details">
                                                    <h5><i class="far fa-clock"></i> {{ date('d M Y',  strtotime($appointment->date)) }}, {{ date('g:m A',  strtotime($appointment->date)) }}</h5>
                                                    <h5><i class="fas fa-map-marker-alt"></i> {{ $appointment->patient->country }}</h5>
                                                    <h5><i class="fas fa-envelope"></i> {{ $appointment->patient->email }}</h5>
                                                    <h5 class="mb-0"><i class="fas fa-phone"></i> {{ $appointment->patient->mobile }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="appointment-action">
                                            <form class="d-inline-block" action="{{ route('appointmets.update', $appointment->id) }}" method="post">
                                                @csrf
                                                @method('patch')

                                                <input type="hidden" name="status" value="finished">
                                                <button type="submit" class="btn btn-sm bg-success-light m"><i class="fas fa-thumbs-up"></i> Finish </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- /Appointment List -->
                                </div>
                            @else
                                <div class="col-md-7 col-lg-8 col-xl-9">
                                    <h2 class="text-center my-3">No Appoinments Accepted</h2>
                                </div>
                            @endif
                            </div>
                        @else
                        <div class="col-md-7 col-lg-8 col-xl-9">
                            <h2 class="text-center my-3">Your profile is not confirmed</h2>
                        </div>
                        @endif
					</div>

				</div>

			</div>
			<!-- /Page Content -->
@endsection
