<?php

namespace App\Http\Controllers;


use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $admin = Auth::user()->admin;

        switch ($admin) {
            case "1":
                $doctors = Doctor::where('status', 'pending')->get();
                return view('admin.index', compact('doctors'));

            case "0":
                return back();
        }


    }

    public function confirmDoctor($id)
    {

        $admin = Auth::user()->admin;

        switch ($admin) {
            case "1":
                $doctor = Doctor::findOrFail($id);
                $doctor->status = 'confirmed';
                $doctor->save();
                return back();

            case "0":
                return back();
        }
    }

    function showConfirmedDoctors()
    {
        $doctors = Doctor::where('status', 'confirmed')->get();

        $admin = Auth::user()->admin;

        switch ($admin) {
            case "1":
                return view('admin.doctors', compact('doctors'));

            case "0":
                return back();
        }


    }

        public function unconfirmDoctor($id)
        {

            $admin = Auth::user()->admin;

            switch ($admin) {
                case "1":
                    $doctor = Doctor::findOrFail($id);
                    $doctor->status = 'pending';
                    $doctor->save();
                    return back();

                case "0":
                    return back();
            }


        }

}
