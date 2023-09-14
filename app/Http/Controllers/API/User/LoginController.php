<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('User.Pages.Login.index');
    }

    public function loginUser(LoginRequest $request)
    {
        $data = $request->validated();

        if (auth()->attempt([
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role'=>'user',
        ])) {
            return redirect()->route('user.dashboard.index');
        }else{
            return redirect()->back()->with('error',"the user is not registered !!");
        }
    }


    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect()->route('user.dashboard.index');
    }

    
    public function register()
    {
        return view('User.Pages.Register.index');
    }

    public function storeUser(StoreUserRequest $request)
    {
         //validation
         $data = $request->validated();


        //upload image
        $full_name = '';

        if ($data['image']) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time().rand(1,10000).".". $img_ext;
            $request->file('image')->move(public_path('User\uploads\images'), $full_name);
        }

        //store
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => "User\uploads\images" . $full_name,
            'role' => 'user'
        ]);

        //redirect
        return redirect()->route('user.login')->with('success', "the user stored successfuly");
    
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
