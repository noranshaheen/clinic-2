<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMajorRequest;
use App\Http\Traits\ApiTrait;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    use ApiTrait;
    public function index()
    {
        $majors = Major::get();
        return $this->apiResponse(200, 'All majors', 'null', $majors);
    }

    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        //upload image
        $full_name = '';

        if ($request->hasFile('image')) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\majors'), $full_name);
        }

        //store
        $major = Major::create([
            'name' => $request->name,
            'image' => "Admin\\images\\uploads\\majors\\" . $full_name,
        ]);

        return $this->apiResponse(201, 'Major created', 'null', $major);
    }

    public function show($id)
    {
        $major = Major::find($id);
        if (!$major) {
            return $this->apiResponse(404, 'major not found', 'Major not found', 'null');
        }
        return $this->apiResponse(200, 'major found', 'null', $major);
    }

    public function update(Request $request, $id)
    {
        $major = Major::find($id);
        if (!$major) {
            return $this->apiResponse(404, 'major not found', 'Major not found', 'null');
        }
        //validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        //upload image
        $full_name = '';

        if ($request->hasFile('image')) {

            if ($major->image) {
                unlink(public_path($major->image));
            }
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\majors'), $full_name);
        }

        //update 
        $major->update([
            'name' => $request->name,
            'image' => $request->image ?
                "Admin\\images\\uploads\\majors\\" . $full_name : $major->image,
        ]);
        return $this->apiResponse(200, 'major updated', 'null', $major);
    }

    public function destroy($id)
    {
        $major = Major::findOrFail($id);
        if (!$major) {
            return $this->apiResponse(404, 'major not found', 'major not found', 'null');
        } else {
            if ($major->image) {
                unlink(public_path($major->image));
            }
            $major->delete();
            return $this->apiResponse(200, 'major deleted', 'null', 'null');
        }
    }
}
