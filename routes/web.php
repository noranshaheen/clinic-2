<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\DoctorController as UserDoctorController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\MajorController as UserMajorController;
use App\Http\Controllers\SettingController;
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

Route::get('/admin/login', [LoginController::class, 'create'])->name('login.create');

Route::post('/admin/login', [LoginController::class, 'store'])->name('login.store');



Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth.admin']
    ],
    function () {
        Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

        //users
        Route::group([
            'prefix' => 'users'
        ], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        });

        //majors
        Route::group([
            'prefix' => 'majors'
        ], function () {
            Route::get('/', [MajorController::class, 'index'])->name('admin.majors.index');
            Route::get('/create', [MajorController::class, 'create'])->name('admin.majors.create');
            Route::post('/store', [MajorController::class, 'store'])->name('admin.majors.store');
            Route::get('/edit/{major}', [MajorController::class, 'edit'])->name('admin.majors.edit');
            Route::put('/update/{major}', [MajorController::class, 'update'])->name('admin.majors.update');
            Route::delete('/delete/{major}', [MajorController::class, 'destroy'])->name('admin.majors.destroy');
        });

        //doctors
        Route::group([
            'prefix' => 'doctors'
        ], function () {
            Route::get('/', [DoctorController::class, 'index'])->name('admin.doctors.index');
            Route::get('/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
            Route::post('/store', [DoctorController::class, 'store'])->name('admin.doctors.store');
            Route::get('/edit/{doctor}', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
            Route::put('/update/{doctor}', [DoctorController::class, 'update'])->name('admin.doctors.update');
            Route::delete('/delete/{doctor}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
        });

        // //bookings
        Route::group([
            'prefix' => 'bookings'
        ], function () {
            Route::get('/', [BookingController::class, 'index'])->name('admin.bookings.index');
            Route::get('/create', [BookingController::class, 'create'])->name('admin.bookings.create');
            Route::post('/store', [BookingController::class, 'store'])->name('admin.bookings.store');
            Route::get('/edit/{booking}', [BookingController::class, 'edit'])->name('admin.bookings.edit');
            Route::put('/update/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
            Route::delete('/delete/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
        });

        //settings
        Route::group([
            'prefix' => 'settings'
        ], function () {
            // Route::get('/', [SettingController::class, 'index'])->name('admin.settings.index');
            Route::get('/create', [SettingController::class, 'create'])->name('admin.settings.create');
            Route::post('/store', [SettingController::class, 'store'])->name('admin.settings.store');
            Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.settings.edit');
            Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.settings.update');
        });
    }
);


Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard.index');

Route::group([
    'prefix' => 'user',
    'middleware' => ['auth.user']
], function () {
    Route::group([
        'controller' =>UserLoginController::class
    ], function () { 
        //login
        Route::get('/login', 'login')->name('user.login')->withoutMiddleware('auth.user')->middleware('guest.user');
        Route::post('/login', 'loginUser')->name('user.login')->withoutMiddleware('auth.user')->middleware('guest.user');
        
        //register
        Route::get('/register', 'register')->name('user.register')->withoutMiddleware('auth.user');
        Route::post('/registr', 'storeUser')->name('user.storeUser')->withoutMiddleware('auth.user');
        
        //logout
        Route::post('/logout','logout')->name('user.logout');
    });

    //get all doctors
    Route::get('/doctors/{id?}', [UserDoctorController::class,'index'])->name('user.doctor.index');
    
    //get all majors
    Route::get('/majors', [UserMajorController::class,'index'])->name('user.major.index');
    
    //contact-us
    Route::get('/contacts', [UserContactController::class,'index'])->name('user.contact.index');
    Route::post('/contacts', [UserContactController::class,'store'])->name('user.contact.store');
    
    //booking
    Route::get('/booking/{doctor_id}', [UserBookingController::class,'create'])->name('user.booking.create');
    Route::post('/booking/{doctor_id}', [UserBookingController::class,'store'])->name('user.booking.store');
    
});