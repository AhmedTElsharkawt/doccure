@extends('layouts.doctor')

@section('title', 'Doctor Details')

@section('breadcrump')
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Doctor Profile</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->
@endsection

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

@section('content')
        <!-- Page Content -->
        <div class="content">
            <div class="container">

                <!-- Doctor Widget -->
                <div class="card">
                    <div class="card-body">
                        <div class="doctor-widget">
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    <img src="{{ asset($doctor->image) }}" class="img-fluid" alt="User Image">
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">{{"Dr. " . $doctor->name  }}</h4>
                                    <p class="doc-speciality">{{$doctor->bio}}</p>

                                    <div class="clinic-details">
                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{$doctor->country}}</p>
                                        <p class="doc-location">
                                            <i class="far fa-money-bill-alt"></i> {{$doctor->price}}
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="doc-info-right">

                                <div class="clinic-booking">
                                    <a class="apt-btn" href="{{ route('booking', [Auth::user()->id, $doctor->id]) }}">Book Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Doctor Widget -->

                <!-- Doctor Details Tab -->
                <div class="card">
                    <div class="card-body pt-0">

                        <!-- Tab Menu -->
                        <nav class="user-tabs mb-4">
                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                                </li>

                            </ul>
                        </nav>
                        <!-- /Tab Menu -->

                        <!-- Tab Content -->
                        <div class="tab-content pt-0">

                            <!-- Overview Content -->
                            <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                <div class="row">
                                    <div class="col-md-12 col-lg-9">

                                        <!-- About Details -->
                                        <div class="widget about-widget">
                                            <h4 class="widget-title">About Me</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                        <!-- /About Details -->



                                    </div>
                                </div>
                            </div>
                            <!-- /Overview Content -->


                        </div>
                    </div>
                </div>
                <!-- /Doctor Details Tab -->

            </div>
        </div>
        <!-- /Page Content -->
@endsection


