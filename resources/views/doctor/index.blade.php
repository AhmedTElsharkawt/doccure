@extends('layouts.doctor')

@section('title', 'Doctor Dashboard')

@section('breadcrump')
                <!-- Breadcrumb -->
                <div class="breadcrumb-bar">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-12">
                                <nav aria-label="breadcrumb" class="page-breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('doctor.home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                                <h2 class="breadcrumb-title">Dashboard</h2>
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
												<a href="{{ route('doctor.appointments', $doctorId) }}">
													<i class="fas fa-calendar-check"></i>
													<span>Appointments</span>
												</a>
											</li>

                                            <li>
                                                <a href="{{ route('doctor.edit', $doctorId) }}">
                                                    <i class="fas fa-user-cog"></i>
                                                    <span>Profile Settings</span>
                                                </a>
                                            </li>

                                            <li>
												<a href="{{ route('edit.doctor.password') }}">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
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

                        <div class="col-md-7 col-lg-8 col-xl-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card dash-card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-6">
                                                    <div class="dash-widget dct-border-rht">
                                                        <div class="circle-bar circle-bar1">
                                                            <div class="circle-graph1" data-percent="75">
                                                                <img src="{{ asset('assets/img/icon-01.png') }}" class="img-fluid" alt="patient">
                                                            </div>
                                                        </div>
                                                        <div class="dash-widget-info">
                                                            <h6>Total Patient</h6>
                                                            <h3>1500</h3>
                                                            <p class="text-muted">Till Today</p>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-12 col-lg-6">
                                                    <div class="dash-widget">
                                                        <div class="circle-bar circle-bar3">
                                                            <div class="circle-graph3" data-percent="50">
                                                                <img src="{{ asset('assets/img/icon-03.png') }}" class="img-fluid" alt="Patient">
                                                            </div>
                                                        </div>
                                                        <div class="dash-widget-info">
                                                            <h6>Appoinments</h6>
                                                            <h3>85</h3>
                                                            <p class="text-muted">06, Apr 2019</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @if ($status == 'confirmed')
                                        @if (!count($appoinments) < 1)
                                        <h4 class="mb-4">Pending Appoinments</h4>
                                        <div class="appointments">
                                            <!-- Appointment List -->
                                                @foreach ( $appoinments as $appointment )
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

                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit" class="btn btn-sm bg-success-light m mx-2"><i class="fas fa-check"></i> Accept </button>
                                                        </form>
                                                        <form action="{{ route('appointmets.update', $appointment->id) }}" method="post">
                                                            @csrf
                                                            @method('patch')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="btn btn-sm bg-danger-light d-inline-block"><i class="fas fa-times"></i> Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endforeach
                                            <!-- /Appointment List -->
                                            </div>
                                        @else
                                            <div class="col-md-7 col-lg-8 col-xl-9">
                                                <h2 class="text-center my-3">No Booked Appoinments !</h2>
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-7 col-lg-8 col-xl-9">
                                            <h2 class="text-center my-3">Your profile is not confirmed</h2>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        </div>
    <!-- /Main Wrapper -->
@endsection

