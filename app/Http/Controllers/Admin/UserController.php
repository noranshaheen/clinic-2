<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(6);
        return view('Admin.Pages.Users.index', compact('users'));
    }


    public function create()
    {
        return view('Admin.Pages.Users.create');
    }


    public function store(StoreUserRequest $request)
    {
        // dd($request);

        //validation
        $data = $request->validated();


        //upload image
        $full_name = '';

        if ($data['image']) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time().rand(1,10000).".". $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\users'), $full_name);
        }

        //store
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => "Admin\\images\\uploads\\users\\" . $full_name,
            'role' => $data['role']
        ]);

        //redirect
        return redirect()->route('admin.users.index')->with('success', "the user stored successfuly");
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        // dd($user);

        return view('Admin.Pages.Users.edit', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        // dd($request);

        $user = User::findOrFail($id);
        
        
        //validation
        $data = $request->validated();

        $checked_password = '';
        if($data['new_password']){
            $checked_password =Hash::check($data['old_password'], $user->password);
            if(!$checked_password) {
                return redirect()->back()->with('error', 'old password is not correct !');
            }
        }
        

        //upload image
        $full_name = '';

        if ($data['image']) {

            if ($user->image) {
                unlink(public_path($user->image));
            }
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time().rand(1,10000).".". $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\users'), $full_name);
        }

        //update 
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $checked_password == true ? Hash::make($data['new_password']): $user->password,
            'image' => $data['image'] ? "Admin\\images\\uploads\\users\\" . $full_name : $user->image,
            'role' => $data['role']
        ]);

        //redirect
        return redirect()->route('admin.users.index')->with('success', "the user updated successfuly");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            unlink(public_path($user->image));
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', "the user deeted successfuly");
    }
}
