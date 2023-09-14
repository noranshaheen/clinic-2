<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('major')->get();
        return $this->apiResponse(200, 'All Doctors', 'null', $doctors);
    }

    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'major_id' => ['required', 'exists:majors,id']
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        //upload image
        $full_name = '';

        if ($request->image) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\doctors'), $full_name);
        }

        //store
        $doctor= Doctor::create([
            'name' => $request->name,
            'image' => "Admin\\images\\uploads\\doctors\\" . $full_name,
            'major_id' => $request->major_id
        ]);

        return $this->apiResponse(201, 'Doctor created', 'null', $doctor);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return $this->apiResponse(404, 'doctor not found', 'doctor not found', 'null');
        }
        return $this->apiResponse(200, 'doctor found', 'null', $doctor);
    }

    public function update(Request $request,$id)
    {
        $doctor = Doctor::findOrFail($id);
        if (!$doctor) {
            return $this->apiResponse(404, 'doctor not found', 'doctor not found', 'null');
        }
        //validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'major_id' => ['required', 'exists:majors,id']
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }
        //upload image
        $full_name = '';

        if ($request->image) {

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
            'name' => $request->name,
            'image' => "Admin\\images\\uploads\\doctors\\" . $full_name,
            'major_id' => $request->major_id
        ]);

        return $this->apiResponse(200, 'doctor updated', 'null', $doctor);
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if (!$doctor) {
            return $this->apiResponse(404, 'doctor not found', 'doctor not found', 'null');
        } else {
            if ($doctor->image) {
                unlink(public_path($doctor->image));
            }
            $doctor->delete();
            return $this->apiResponse(200, 'doctor deleted', 'null', 'null');
        }
    }
}

