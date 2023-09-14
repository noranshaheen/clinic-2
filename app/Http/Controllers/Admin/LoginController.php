<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        if(auth()->user()){
            return redirect()->route('admin.dashboard');
        }
        return view('Admin.Pages.Login.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard()
    {
        $doctors = Doctor::count();
        $majors = Major::count();
        $users = User::count();
        $bookings = Booking::count();
        return view('Admin\index',compact(['doctors','majors','users','bookings']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $data= $request->validated();

        // dd($data);

        if (auth()->attempt([
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role'=>'admin',
        ])) {
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('error',"the user is not an admin !!");
        }
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
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect()->route('login.create');
    }
}
