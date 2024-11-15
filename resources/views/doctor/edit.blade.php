@extends('layouts.doctor')

@section('title', 'Edit Profile')

@section('breadcrump')
                <!-- Breadcrumb -->
                <div class="breadcrumb-bar">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-12">
                                <nav aria-label="breadcrumb" class="page-breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('doctor.home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                                    </ol>
                                </nav>
                                <h2 class="breadcrumb-title">Profile Settings</h2>
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
                                    <a href="{{ asset($doctor->image) }}" class="booking-doc-img" target="_blanck">
                                        <img src="{{ asset($doctor->image) }}" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3>{{"Dr. " . Auth::guard('doctors')->user()->name}}</h3>

                                        <div class="patient-details">
                                            <h5 class="mb-0">{{ Auth::guard('doctors')->user()->bio}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-widget">
                                <nav class="dashboard-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ route('doctor.home') }}">
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
                        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <!-- Basic Information -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Basic Information</h4>
                                    <div class="row form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="change-avatar">
                                                    <div class="profile-img">
                                                        <img src="{{ asset($doctor->image) }}" alt="User Image">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" type="text" class="form-control" value="{{ Auth::guard('doctors')->user()->name }}">

                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="email" type="email" class="form-control" value="{{ Auth::guard('doctors')->user()->email }}">

                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input name="mobile" type="text" class="form-control" value="{{ Auth::guard('doctors')->user()->mobile }}">

                                                @error('mobile')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Country</label>
                                                <input name="country" type="text" class="form-control" value="{{ Auth::guard('doctors')->user()->country }}">

                                                @error('country')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                            <div class="col-md-12">
                                                <div id="scheduleContainer">
                                                    <div class="schedule-item">
                                                        <label for="day">Choose Day: </label>
                                                        <select name="day[]" required>
                                                            <option value="Monday">Monday</option>
                                                            <option value="Tuesday">Tuesday</option>
                                                            <option value="Wednesday">Wednesday</option>
                                                            <option value="Thursday">Thursday</option>
                                                            <option value="Friday">Friday</option>
                                                            <option value="Saturday">Saturday</option>
                                                            <option value="Sunday">Sunday</option>
                                                        </select>

                                                        @error('day[]')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror

                                                        <label for="start_time">start_time</label>
                                                        <input type="time" name="start_time[]" required>

                                                        @error('start_time[]')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror

                                                        <label for="end_time">end_time</label>
                                                        <input type="time" name="end_time[]" required>

                                                        @error('end_time[]')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button type="button" onclick="addSchedule()">Add onther date</button>
                                            </div>


                                    </div>
                                </div>
                            </div>
                            <!-- /Basic Information -->

                            <!-- About Me -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">About Me</h4>
                                    <div class="form-group mb-0">
                                        <label>Biography</label>
                                        <textarea name="bio" class="form-control" rows="5">{{ Auth::guard('doctors')->user()->bio }}</textarea>

                                        @error('bio')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /About Me -->

                            <!-- Pricing -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pricing</h4>

                                    <div class="form-group mb-0">
                                        <div id="pricing_select">
                                            <input name="price" type="text" class="form-control" id="custom_rating_input" value="{{ Auth::guard('doctors')->user()->price }}">

                                            @error('price')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Pricing -->





                            <div class="submit-section submit-btn-bottom">
                                <button type="submit" onclick="submitSchedule()" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
@endsection



