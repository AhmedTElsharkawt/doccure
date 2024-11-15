<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with('doctor')
        ->where('user_id', Auth::user()->id)->get();

        $birthDate = Carbon::parse(Auth::user()->date_of_birth);

        $age = $birthDate->diffInYears(Carbon::now());
        // $age =  $birthDate->diff(Carbon::now())->format('%y years, %m months and %d days');

        return view('patient.index', compact('appointments', 'age'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $schedules = json_decode($doctor->dates, true);

        $availableTimes = [];

        foreach ($schedules as $schedule) {
            $availableTimes[$schedule['day']][] = [
                'start_time' => $schedule['start_time'],
                'end_time' => $schedule['end_time'],
            ];
        }

        return view('appointment.booking', compact( 'doctor', 'availableTimes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $userId, $doctorId)
    {
        $user = User::find($userId);
        $doctor = Doctor::find($doctorId);
        // Fetch Data
        $inputs = $request->all();

        // dd($inputs);
        // Create data
        Appointment::create($inputs);

        // Redirect
        return view('Appointment.booking_success', compact('user', 'doctor', 'inputs'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $doctorId = Auth::guard('doctors')->user()->id;

        $status = Auth::guard('doctors')->user()->status;

        // accepted appointments
        $appointments = Appointment::with('patient')
        ->where([
            ['doctor_id', '=', $doctorId],
            ['status', '=', 'accepted']
        ])->get();

        return view('doctor.appointments', compact('doctorId', 'appointments', 'status'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('status');

        // $request->validate(['status' => 'string|max:10',]);

        $appointment = Appointment::find($id);


        $appointment->update($input);

        // $appointmen->update(['status'=> 'asdf']);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Appointment::find($id)->delete();

        return redirect(route('index'));
    }
}
