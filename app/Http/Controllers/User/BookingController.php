<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($doctor_id)
    {

        $doctor = Doctor::with('major')->where('id','=',$doctor_id)->first();
        return view('User.Pages.Booking.create',compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request,$doctor_id)
    {
        // dd($request, $doctor_id);
        $data=$request->validated();

        Booking::create([
            'name'=>$data['name'],
            'phone' =>$data['phone'],
            'date' => $data['date'],
            'email' => $data['email'],
            'doctor_id' => $doctor_id
        ]);

        $doctor = Doctor::with('major')->where('id','=',$doctor_id)->first();
        return view('User.Pages.Booking.create',compact('doctor'))->with('success','booking stored successfuly');
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
