<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    use ApiTrait;
    public function index()
    {
        $users = User::get();
        return $this->apiResponse(200, 'All users', 'null', $users);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:100', 'min:6'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'role' => ['required']
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        //upload image
        $full_name = '';

        if ($request->image) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\users'), $full_name);
        }

        //store
        $User=User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'image' => "Admin\\images\\uploads\\users\\" . $full_name,
            'role' => $request['role']
        ]);

        return $this->apiResponse(201, 'user created', 'null', $User);
    }


    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->apiResponse(404, 'User not found', 'User not found', 'null');
        }
        return $this->apiResponse(200, 'User found', 'null', $user);
    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return $this->apiResponse(404, 'User not found', 'User not found', 'null');
        }
        //validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'old_password' => ['nullable', 'max:100', 'min:6'],
            'new_password' => ['nullable', 'max:100', 'min:6'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpej'],
            'role' => ['required']
        ]);


        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        $checked_password = '';
        if ($request->new_password) {
            $checked_password = Hash::check($request->old_password, $user->password);
            if (!$checked_password) {
                return redirect()->back()->with('error', 'old password is not correct !');
            }
        }

        //upload image
        $full_name = '';

        if ($request->image) {

            if ($user->image) {
                unlink(public_path($user->image));
            }
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time() . rand(1, 10000) . "." . $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\users'), $full_name);
        }

        //update 
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $checked_password == true ? Hash::make($request->new_password) : $user->password,
            'image' => $request->image ? "Admin\\images\\uploads\\users\\" . $full_name : $user->image,
            'role' => $request->role
        ]);

        return $this->apiResponse(200, 'user updated', 'null', $user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return $this->apiResponse(404, 'user not found', 'user not found', 'null');
        } else {
            if ($user->image) {
                unlink(public_path($user->image));
            }
            $user->delete();
            return $this->apiResponse(200, 'User deleted', 'null', 'null');
        }
    }
}
