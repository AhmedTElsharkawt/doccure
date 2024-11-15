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
                                <li class="breadcrumb-item"><a href="{{ route('login') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Booking</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Reserve Appointment</h2>
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
        <div class="content success-page-cont">
            <div class="container-fluid">

                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <!-- Success Card -->
                        <div class="card success-card">
                            <div class="card-body">
                                <div class="success-cont">
                                    <i class="fas fa-check"></i>
                                    <h3>Appointment booked Successfully!</h3>
                                    <p>Appointment booked with <strong> {{ $doctor->name }} </strong><br> on <strong>{{ date('d M Y',  strtotime($inputs['date'])) . " " . date('g:m A',  strtotime($inputs['time'])) }}</strong></p>
                                    <a href="{{ route('show.doctors', $doctor) }}" class="btn btn-primary view-inv-btn">Go To Doctors</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Success Card -->

                    </div>
                </div>

            </div>
        </div>
        <!-- /Page Content -->
@endsection


