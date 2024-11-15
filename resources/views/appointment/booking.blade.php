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
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="booking-doc-info">
                                    <a href="{{ asset($doctor->image) }}" class="booking-doc-img" target="_blank">
                                        <img src="{{ asset($doctor->image) }}" alt="User Image">
                                    </a>
                                    <div class="booking-info">
                                        <h4><a href="{{ route('doctor.details', $doctor->id) }}">{{ $doctor->name }}</a></h4>

                                        <p class="text-muted mb-3"><i class="fas fa-map-marker-alt"></i> {{ $doctor->country }}</p>
                                        <p class="doc-location">
                                            <i class="far fa-money-bill-alt"></i> {{ $doctor->price }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <form  action="{{ route('do.booking', [Auth::user()->id, $doctor->id]) }}" method="post">
                        @csrf
                            <input type="text" name="doctor_id" hidden value="{{$doctor->id}}">
                            <input type="text" name="user_id" hidden value="{{Auth::user()->id}}">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="day">Choose day</label>
                            <select name="date" id="day" onchange="fetchAvailableTimes()">
                                <option value="">Choose day</option>
                                @foreach ($availableTimes as $day => $times)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>

                            <label for="time">Choose time</label>
                            <select name="time" id="time" disabled>
                                <option value="">Choose time first</option>
                            </select>

                            <div id="availableTimes">

                            </div>
                        </div>
                    </div>



							<!-- Schedule Widget -->

							<!-- /Schedule Widget -->

							<!-- Submit Section -->
							<div class="submit-section proceed-btn text-right">
								<button type="submit" class="btn btn-primary submit-btn">Make Appointment</button>
							</div>
							<!-- /Submit Section -->
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

<script>
    function fetchAvailableTimes() {
        const day = document.getElementById('day').value;

        if (!day) {
            document.getElementById('time').disabled = true;
            document.getElementById('time').innerHTML = '<option value="">Choose time first</option>';
            document.getElementById('availableTimes').innerHTML = '';
            return;
        }

        const availableTimes = @json($availableTimes);
        const times = availableTimes[day] || [];

        let output = '';
        let timeOptions = '';

        if (times.length > 0) {
            times.forEach(time => {
                output += `<p>From ${time.start_time} to ${time.end_time}</p>`;

                let startTime = new Date(`1970-01-01T${time.start_time}:00`);
                let endTime = new Date(`1970-01-01T${time.end_time}:00`);
                let timeSlot = generateTimeSlots(startTime, endTime);

                timeSlot.forEach(slot => {
                    timeOptions += `<option value="${slot}">${slot}</option>`;
                });
            });

            document.getElementById('time').disabled = false;
            document.getElementById('time').innerHTML = timeOptions;
        } else {
            output = '<p>There is no date for this day</p>';
        }

        document.getElementById('availableTimes').innerHTML = output;
    }

    function generateTimeSlots(startTime, endTime) {
        let slots = [];
        while (startTime < endTime) {
            let hours = startTime.getHours().toString().padStart(2, '0');
            let minutes = startTime.getMinutes().toString().padStart(2, '0');
            slots.push(`${hours}:${minutes}`);
            startTime.setMinutes(startTime.getMinutes() + 60);
        }
        return slots;
    }
</script>

@endsection


