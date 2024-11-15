<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Doctors;
use App\Models\Appointment;
use App\Models\Doctor;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctorId = Auth::guard('doctors')->user()->id;

        $status = Auth::guard('doctors')->user()->status;

        // Pending appointments
        $appoinments = Appointment::with('patient')
            ->where([
                ['doctor_id', '=', $doctorId],
                ['status', '=', 'pending']
            ])->get();

        // Show doctor.index view
        return view('doctor.index', compact('doctorId', 'appoinments', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Set variable data
        $input = $request->except('image');

        // $request->validate([
        //     'image' => 'mimes:jpeg,png,jpg,gif|max:2049',
        //     'name' => 'string|min:3',
        //     'email' => 'string|email',
        //     'mobile' => 'max:15',
        //     'country' => 'string|max:25',
        //     'bio' => 'string|max:255',
        //     'price' => 'string|max:25',

        // ]);


        if ($request->hasFile('image'))
        {
            $imageFile = $request->image;
            $imageExtension = $imageFile->getClientOriginalExtension();
            $newImageName = date('Y-m-d-') . uniqId() . '.' . $imageExtension;
            $imageFile->move('images/', $newImageName);
            $path = "images/$newImageName";
            $input['image'] = $path;
        }

        $data = $request->validate([
            'day' => 'required|array',
            'day.*' => 'required|string',
            'start_time' => 'required|array',
            'start_time.*' => 'required|date_format:H:i',
            'end_time' => 'required|array',
            'end_time.*' => 'required|date_format:H:i|after:start_time.',
            ]);

            // dd($data);

            $schedules = [];
            for ($i = 0; $i < count($data['day']); $i++) {
                $schedules[] = [
                    'day' => $data['day'][$i],
                    'start_time' => $data['start_time'][$i],
                    'end_time' => $data['end_time'][$i],
                ];
            }



            $jsonData = json_encode($schedules);

            $input['dates'] = $jsonData;

            Doctor::find(Auth::guard('doctors')->user()->id)->update($input);


            return redirect(route('doctor.home'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }


    function Login()
    {

        return view('doctor.login');
    }

    function register()
    {
        return view('doctor.register');
    }

    function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|string|email|unique:doctors,email',
            'password' => 'required|min:8|string'
        ]);

        $input = $request->except('password');
        $input['password'] = Hash::make($request->password);

        Doctor::create($input);

        return redirect()->route('doctor.login');

    }

    function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|string|email',
            'password' => 'required|min:6|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('doctors')->attempt($credentials)){
            return redirect()->route('doctor.home');
        }

        return redirect()->route('doctor.login');
    }

    function logout()
    {
        Auth::guard('doctors')->logout();

        return redirect()->route('doctor.login');
    }


    public function editPassword()
    {
        return view('doctor.edit_password');
    }


    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
        ]);

        // Get the authenticated user
        $user = Auth::guard('doctors')->user();

        // Check if the current password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 403);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect(route('doctor.home'));
    }
}
