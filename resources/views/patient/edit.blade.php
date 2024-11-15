@extends('layouts.doctor')

@section('title', 'Edit Profile')

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
                                        <li class="breadcrumb-item"><a href="{{ route('doctor.home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Profile Setting</li>
                                    </ol>
                                </nav>
                                <h2 class="breadcrumb-title">Profile Setting</h2>
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
                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                        <!-- Profile Sidebar -->
                        <div class="profile-sidebar">
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="{{ asset($user->image) }}" class="booking-doc-img" target="_blanck">
                                        <img src="{{ asset($user->image) }}" alt="User Image">
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
                        <!-- /Profile Sidebar -->

                    </div>
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <form action="{{ route('patient.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <!-- Profile Settings Form -->
                            <form action="" method="" enctype="multipart/form-data">
                                <div class="row form-row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                <div class="profile-img">
                                                    <img src="{{ asset($user->image) }}" alt="User Image">
                                                </div>
                                                <div class="upload-img">
                                                    <div class="change-photo-btn">
                                                        <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                        <input name="image" type="file" class="upload">
                                                    </div>
                                                    @error('image')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control" value="{{ Auth::user()->name }}">

                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <div class="cal-icon">
                                                <input name="date_of_birth" type="date" class="form-control datetimepicker" value="{{ Auth::user()->date_of_birth }}">

                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <select name="blood_group" class="form-control select">
                                                <option>A-</option>
                                                <option>A+</option>
                                                <option>B-</option>
                                                <option>B+</option>
                                                <option>AB-</option>
                                                <option>AB+</option>
                                                <option>O-</option>
                                                <option>O+</option>
                                            </select>

                                            @error('blood_group')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input name="mobile" type="text" value="{{ Auth::user()->mobile }}" class="form-control">

                                            @error('mobile')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                        <label>Country</label>
                                            <input name="country" type="text" class="form-control" value="{{ Auth::user()->country }}">

                                            @error('country')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                </div>
                            </form>
                            <!-- /Profile Settings Form -->
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
@endsection







