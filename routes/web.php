<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Admin routes

Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/show/doctors', [AdminController::class, 'showConfirmedDoctors'])->name('admin.show.doctors');
    Route::put('/admin/confirm/{doctor}', [AdminController::class, 'confirmDoctor'])->name('admin.confirm.doctor');
    Route::put('/admin/unconfirm/{doctor}', [AdminController::class, 'unconfirmDoctor'])->name('admin.unconfirm.doctor');
});

// Patient Routes
Auth::routes(['verify' => true]);

// You must login first
Route::middleware(['auth'])->group(function(){
    Route::get('/home', [AppointmentController::class, 'index'])->name('index');
    Route::get('/appointments/create/{user}/{doctor}', [AppointmentController::class, 'create'])->name('booking');
    Route::post('/appointments/store/{user}/{doctor}', [AppointmentController::class, 'store'])->name('do.booking');
    Route::get('/edit/{patient}', [HomeController::class, 'edit'])->name('patient.edit');
    Route::put('/update/{patient}', [HomeController::class, 'update'])->name('patient.update');
    Route::get('/patient/doctors', [HomeController::class, 'showDoctors'])->name('show.doctors');
    Route::get('/patient/docdetils/{doctor}', [HomeController::class, 'doctorDetails'])->name('doctor.details');
    Route::delete('/appointments{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
    Route::get('/patient/edit-password', [HomeController::class, 'editPassword'])->name('edit.patient.password');
    Route::put('/patient/update-password', [HomeController::class, 'updatePassword'])->name('update.patient.password');

});


// Doctor Routes
Route::middleware(['guest.doctor'])->group(function(){
    Route::get('/doctor/login', [DoctorController::class, 'Login'])->name('doctor.login');
    Route::get('/doctor/register', [DoctorController::class, 'register'])->name('doctor.register');
    Route::post('/doctor/register', [DoctorController::class, 'doRegister'])->name('doctor.doregister');
    Route::post('/doctor/login', [DoctorController::class, 'doLogin'])->name('doctor.dologin');

});

// You must login first
Route::middleware(['doctors', 'verified'])->group(function () {
    Route::get('/doctor/home', [DoctorController::class, 'index'])->name('doctor.home');
    Route::get('/doctor/appointments', [AppointmentController::class, 'show'])->name('doctor.appointments');
    Route::get('/doctor/logout', [DoctorController::class, 'logout'])->name('doctor.logout');
    Route::get('/doctor/edit-password', [DoctorController::class, 'editPassword'])->name('edit.doctor.password');
    Route::put('/doctor/update-password/', [DoctorController::class, 'updatePassword'])->name('update.doctor.password');
    Route::get('/doctor/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/doctor/{doctor}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::get('/appointments/{appointment}edit', [AppointmentController::class, 'edit'])->name('appointmets.edit');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointmets.update');

});


