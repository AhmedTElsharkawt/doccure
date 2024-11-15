@extends('layouts.doctor')

@section('title', 'Doctors List')

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
                                        <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Admin</li>
                                    </ol>
                                </nav>
                                <h2 class="breadcrumb-title">Admin Dashboard</h2>
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
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="{{ route('admin.show.doctors') }}">
													<i class="fas fa-user-md"></i>
													<span>Confirmed Doctors</span>
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
                                <nav class="user-tabs mb-4">
                                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Doctros need to confirm </a>
                                        </li>

                                    </ul>
                                </nav>

                                <div class="row row-grid">
                                    @foreach ($doctors as $doctor)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="profile-widget">
                                                <div class="doc-img">
                                                    <a href="{{ asset($doctor->image) }} " target="_blanck">
                                                        <img class="img-fluid" alt="User Image" src="{{ asset($doctor->image) }}">
                                                    </a>
                                                    <a href="javascript:void(0)" class="fav-btn">
                                                        <i class="far fa-bookmark"></i>
                                                    </a>
                                                </div>
                                                <div class="pro-content">
                                                    <h3 class="title">
                                                        <a href="{{ route('doctor.details', $doctor->id) }}">{{ $doctor->name }}</a>
                                                        <i class="fas fa-check-circle verified"></i>
                                                    </h3>
                                                    <p class="speciality">{{ $doctor->bio }}</p>

                                                    <ul class="available-info">
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i> {{ $doctor->country }}
                                                        </li>

                                                        <li>
                                                            <i class="far fa-money-bill-alt"></i> {{ $doctor->price }} <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="row row-sm">
                                                        <div class="col-6">
                                                            <a href="{{ route('doctor.details', $doctor->id) }}" class="btn view-btn">View Profile</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <form action="{{ route('admin.confirm.doctor', $doctor->id) }}" method="post">
                                                                @csrf
                                                                @method('put')

                                                                <button class="btn book-btn" type="submit">Confirm</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

						</div>
					</div>

				</div>

			</div>
			<!-- /Page Content -->
@endsection

