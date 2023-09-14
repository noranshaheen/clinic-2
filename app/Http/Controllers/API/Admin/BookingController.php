<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use Dotenv\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class BookingController extends Controller
{
    use ApiTrait;
    public function index()
    {
        $bookings = Booking::with('doctor')->get();
        return $this->apiResponse(200, 'All Bookings', 'null', $bookings);

    }

    public function store(Request $request)
    {
        //validation
        $validator = FacadesValidator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:100', 'min:6'],
            'date' => ['required', 'date'],
            'doctor_id' => ['required','exists:doctors,id']
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
            'doctor_id' => $request->doctor_id
        ]);

        return $this->apiResponse(201, 'booking created', 'null', $booking);

    }
     public function show($id)
     {
         $booking= Booking::find($id);
         if (!$booking) {
             return $this->apiResponse(404, 'booking not found', 'booking not found', 'null');
         }
         return $this->apiResponse(200, 'booking found', 'null', $booking);
     }

    public function update(Request $request,$id)
    {
        $booking= Booking::find($id);
        if (!$booking) {
            return $this->apiResponse(404, 'booking not found', 'booking not found', 'null');
        }

         //validation
         $validator = FacadesValidator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:100', 'min:6'],
            'date' => ['required', 'date'],
            'doctor_id' => ['required','exists:doctors,id']
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        //store
        $booking->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'doctor_id' => $request->doctor_id
        ]);

        return $this->apiResponse(200, 'booking updated', 'null', $booking);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        if (!$booking) {
            return $this->apiResponse(404, 'booking not found', 'booking not found', 'null');
        } else {
            $booking->delete();
            return $this->apiResponse(200, 'booking deleted', 'null', 'null');
        }
    }
}
