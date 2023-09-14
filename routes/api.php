<?php

use App\Http\Controllers\API\Admin\BookingController;
use App\Http\Controllers\API\Admin\DoctorController;
use App\Http\Controllers\API\Admin\MajorController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\User\BookingController as UserBookingController;
use App\Http\Controllers\API\User\ContactController;
use App\Http\Controllers\API\User\DoctorController as UserDoctorController;
use App\Http\Controllers\API\User\MajorController as UserMajorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(
    [
        'prefix' => 'admin',
    ],
    function () {

        //users
        Route::group([
            'prefix' => 'users',
        ], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/show/{id}', [UserController::class, 'show'])->name('admin.users.show');
            Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        });

        //majors
        Route::group([
            'prefix' => 'majors'
        ], function () {
            Route::get('/', [MajorController::class, 'index'])->name('admin.majors.index');
            Route::get('/show/{id}', [MajorController::class, 'show'])->name('admin.majors.show');
            Route::post('/store', [MajorController::class, 'store'])->name('admin.majors.store');
            Route::post('/update/{id}', [MajorController::class, 'update'])->name('admin.majors.update');
            Route::delete('/delete/{id}', [MajorController::class, 'destroy'])->name('admin.majors.destroy');
        });

        //doctors
        Route::group([
            'prefix' => 'doctors'
        ], function () {
            Route::get('/', [DoctorController::class, 'index'])->name('admin.doctors.index');
            Route::get('/show/{id}', [DoctorController::class, 'show'])->name('admin.doctors.show');
            Route::post('/store', [DoctorController::class, 'store'])->name('admin.doctors.store');
            Route::post('/update/{id}', [DoctorController::class, 'update'])->name('admin.doctors.update');
            Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
        });

        //bookings
        Route::group([
            'prefix' => 'bookings'
        ], function () {
            Route::get('/', [BookingController::class, 'index'])->name('admin.bookings.index');
            Route::get('/show/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');
            Route::post('/store', [BookingController::class, 'store'])->name('admin.bookings.store');
            Route::post('/update/{id}', [BookingController::class, 'update'])->name('admin.bookings.update');
            Route::delete('/delete/{id}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
        });
    }
);


Route::group(
    [
        'prefix' => 'user',
    ],
    function () {
        //get all doctors
        Route::get('/doctors/{id?}', [UserDoctorController::class, 'index'])->name('user.doctor.index');

        //get all majors
        Route::get('/majors', [UserMajorController::class, 'index'])->name('user.major.index');

        //contact-us
        Route::post('/contacts', [ContactController::class, 'store'])->name('user.contact.store');

        //booking
        Route::post('/booking/{doctor_id}', [UserBookingController::class, 'store'])->name('user.booking.store');
    }
);
