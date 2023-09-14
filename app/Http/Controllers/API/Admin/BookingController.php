<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('doctor')->paginate(6);
        return view('Admin.Pages.Bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::get();
        return view('Admin.Pages.Bookings.create',compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
          //validation
          $data=$request->validated();

        //store
        Booking::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'date' => $data['date'],
            'doctor_id' => $data['doctor_id']
        ]);

        //redirect
        return redirect()->route('admin.bookings.index')->with('success', "the booking stored successfuly");

    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $doctors = Doctor::get();
        return view('Admin.Pages.Bookings.edit', compact(['doctors', 'booking']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookingRequest $request, Booking $booking)
    {
    
        //validation
        $data = $request->validated();

        //store
        $booking->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'date' => $data['date'],
            'doctor_id' => $data['doctor_id']
        ]);

        //redirect
        return redirect()->route('admin.bookings.index')->with('success', "the booking updated successfuly");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', "the booking deleted successfuly");

    }
}
