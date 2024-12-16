<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

// Homepage
Route::get('/', function () {
    return view('yoshHomePage');
})->name('yosh.home');

// Events
Route::get('/add-event', function () {
    return view('addEvent');
})->name('add.event');

Route::get('/approve-event', function () {
    return view('approveEvent');
})->name('approve.event');

Route::get('/event-form', function () {
    return view('eventForm');
})->name('event.form');

Route::get('/event-list', function () {
    return view('eventList');
})->name('event.list');

Route::post('/event-submit', function () {
    // Handle event submission logic here
    return redirect()->route('event.list');
})->name('event.submit');

// Volunteers
Route::get('/heading-volunteer', function () {
    return view('headingVolunteer');
})->name('volunteer.heading');

Route::get('/input-profile', function () {
    return view('inputProfile');
})->name('input.profile');

// Login/Logout
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/login-interface-staff', function () {
    return view('loginInterfaceStaff');
})->name('login.interface.staff');

Route::get('/login-staff', function () {
    return view('loginStaff');
})->name('login.staff');

Route::get('/logout', function () {
    // Handle logout logic here
    return redirect()->route('yosh.home');
})->name('logout');

// Staff
Route::get('/staff-home', function () {
    return view('staffHomePage');
})->name('staff.home');

// Profile & Notifications
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/notification', function () {
    return view('notification');
})->name('notification');

// Event Management
Route::get('/manage-list-event', function () {
    return view('manageListEvent');
})->name('manage.event');

Route::get('/update-event', function () {
    return view('updateEvent');
})->name('update.event');

// Attendance
Route::get('/mark-attendance', function () {
    return view('markatt');
})->name('mark.attendance');

// Stores
Route::get('/registration-store', function () {
    return view('registrationStore');
})->name('register.store');

Route::post('/login-store', [AuthController::class, 'store'])->name('login.store');

Route::get('/input-store', function () {
    return view('inputStore');
})->name('input.store');
