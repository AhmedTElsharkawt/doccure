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
												<a href="{{ route('edit.patient.password') }}">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
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
								<div class="card-body pt-0">
                                    @if (!count($appointments) < 1)
                                        <!-- Tab Menu -->
                                        <nav class="user-tabs mb-4">
                                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
                                                </li>

                                            </ul>
                                        </nav>
                                        <!-- /Tab Menu -->

                                        <!-- Tab Content -->
                                        <div class="tab-content pt-0">

                                            <!-- Appointment Tab -->
                                            <div id="pat_appointments" class="tab-pane fade show active">
                                                <div class="card card-table mb-0">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Doctor</th>
                                                                        <th>Appt Date</th>
                                                                        <th>Booking Date</th>
                                                                        <th>Price</th>
                                                                        <th>Status</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($appointments as $appointment)
                                                                    @php($status = $appointment->status)
                                                                        <tr>
                                                                            <td>
                                                                                <h2 class="table-avatar">
                                                                                    <a href="{{ asset($appointment->doctor->image) }}" target="_blanck" class="avatar avatar-sm mr-2">
                                                                                        <img class="avatar-img rounded-circle" src="{{ asset($appointment->doctor->image) }}" alt="User Image">
                                                                                    </a>
                                                                                    <a href="{{ route('doctor.details',  $appointment->doctor->id) }}">{{ $appointment->doctor->name }} <span></span></a>
                                                                                </h2>
                                                                            </td>
                                                                            <td>{{ date('d M Y',  strtotime($appointment->date)) }} <span class="d-block text-info">{{ date('g:m A',  strtotime($appointment->time)) }}</span></td>
                                                                            <td>{{ $appointment->created_at->format('d M Y') }}</td>
                                                                            <td>{{ $appointment->doctor->price }}</td>

                                                                            <td><span class="badge badge-pill
                                                                                            bg-{{ $status == 'pending' ? 'warning' :
                                                                                                (($status == 'accepted') ? 'success' : 'danger') }}-light">
                                                                                            {{ $status }}</span></td>
                                                                            <td class="text-right">
                                                                                <div class="table-action">
                                                                                    <form action="{{ route('appointment.destroy', $appointment->id) }}" method="post">
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <button class="btn btn-sm bg-danger-light"
                                                                                            type="submit"><i class="far fa-trash-alt"></i> Delete
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Appointment Tab -->

                                        </div>
                                        <!-- Tab Content -->
                                    @else
                                        <nav class="user-tabs mb-4">
                                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#pat_appointments" data-toggle="tab">No Booked Appointments! </a>
                                                </li>

                                            </ul>
                                        </nav>
                                    @endif

								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<!-- /Page Content -->
@endsection

