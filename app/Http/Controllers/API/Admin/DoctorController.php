<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('major')->paginate(6);
        return view('Admin.Pages.Doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::get();
        return view('Admin.Pages.Doctors.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        //validation
        $data = $request->validated();


        //upload image
        $full_name = '';

        if ($data['image']) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\doctors'), $full_name);
        }

        //store
        Doctor::create([
            'name' => $data['name'],
            'image' => "Admin\\images\\uploads\\doctors\\" . $full_name,
            'major_id' => $data['major_id']
        ]);

        //redirect
        return redirect()->route('admin.doctors.index')->with('success', "the doctor stored successfuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $majors = Major::get();
        return view('Admin.Pages.Doctors.edit', compact(['doctor', 'majors']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();

        //upload image
        $full_name = '';

        if ($data['image']) {

            if ($doctor->image) {
                unlink(public_path($doctor->image));
            }
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\doctors'), $full_name);
        }
        //update 
        $doctor->update([
            'name' => $data['name'],
            'image' => "Admin\\images\\uploads\\doctors\\" . $full_name,
            'major_id' => $data['major_id']
        ]);

        //redirect
        return redirect()->route('admin.doctors.index')->with('success', "the doctor updated successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        if ($doctor->image) {
            unlink(public_path($doctor->image));
        }
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', "the doctor deeted successfuly");
    }
}
