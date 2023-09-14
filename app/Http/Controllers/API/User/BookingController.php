<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ApiTrait;


class BookingController extends Controller
{
    use ApiTrait;
    public function index()
    {
        $bookings = Booking::with('doctor')->get();
        return $this->apiResponse(200, 'All Bookings', 'null', $bookings);
    }

    public function store(Request $request,$doctor_id)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:100', 'min:6'],
            'date' => ['required', 'date'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        //store
        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'doctor_id' => $doctor_id 
        ]);

        return $this->apiResponse(201, 'booking created', 'null', $booking);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
