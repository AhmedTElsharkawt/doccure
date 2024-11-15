<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    function showDoctors()
    {
        $doctors = Doctor::where('status', 'confirmed')->get();

        $birthDate = Carbon::parse(Auth::user()->date_of_birth);

        $age = $birthDate->diffInYears(Carbon::now());
        // $age =  $birthDate->diff(Carbon::now())->format('%y years, %m months and %d days');

        return view('patient.doctors', compact('doctors', 'age'));
    }

    function doctorDetails($id)
    {
        $doctor = Doctor::find($id);

        return view('patient.doctor_details', compact('doctor'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        $birthDate = Carbon::parse(Auth::user()->date_of_birth);

        $age = $birthDate->diffInYears(Carbon::now());
        // $age =  $birthDate->diff(Carbon::now())->format('%y years, %m months and %d days');

        return view('patient.edit', compact('user', 'age'));
    }

    public function update(Request $request, $id)
    {
        // Set variable data
        $input = $request->except('image');

        // Validate Data
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,gif|max:2049',
            'name' => 'string|min:3',
            'email' => 'string|email',
            'mobile' => 'max:15',
        ]);

        // Upload image
        if ($request->hasFile('image'))
        {
            $imageFile = $request->image;
            $imageExtension = $imageFile->getClientOriginalExtension();
            $newImageName = date('Y-m-d-') . uniqId() . '.' . $imageExtension;
            $imageFile->move('images/', $newImageName);
            $path = "images/$newImageName";
            $input['image'] = $path;
        }

        // Update data
        $user = User::find($id);
        $user->update($input);

        // Redirect
        return redirect(route('index'));
    }


    public function editPassword()
    {

        $birthDate = Carbon::parse(Auth::user()->date_of_birth);

        $age = $birthDate->diffInYears(Carbon::now());
        // $age =  $birthDate->diff(Carbon::now())->format('%y years, %m months and %d days');

        return view('patient.edit_password', compact('age'));
    }


    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 403);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect(route('index'));
    }



}
