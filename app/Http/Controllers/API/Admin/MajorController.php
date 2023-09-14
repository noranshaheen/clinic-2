<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMajorRequest;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::paginate(6);
        return view('Admin.Pages.Majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Pages.Majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        //validation
        $data = $request->validated();


        //upload image
        $full_name = '';

        if ($request->hasFile('image')) {
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time().rand(1,10000).".". $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\majors'), $full_name);
        }

        //store
        Major::create([
            'name' => $data['name'],
            'image' => "Admin\\images\\uploads\\majors\\" . $full_name,
        ]);


        //redirect
        return redirect()->route('admin.majors.index')->with('success', "the major stored successfuly");
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        return view('Admin.Pages.Majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMajorRequest $request, Major $major)
    {
         //validation
        $data= $request->validated();

        // dd($data);

        //upload image
        $full_name = '';

        if ($request->hasFile('image')) {

            if ($major->image) {
                unlink(public_path($major->image));
            }
            $img_ext = $request->file('image')->getClientOriginalExtension();
            // $img_name = $request->file('image')->getClientOriginalName();

            $full_name =  time().rand(1,10000).".". $img_ext;
            $request->file('image')->move(public_path('Admin\images\uploads\majors'), $full_name);
        }

         //update 
         $major->update([
            'name' => $data['name'],
            'image' => $data['image'] ? 
                        "Admin\\images\\uploads\\majors\\" . $full_name : $major->image,
        ]);

        //redirect
        return redirect()->route('admin.majors.index')->with('success', "the major updated successfuly");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        if ($major->image)
            unlink(public_path($major->image));
        $major->delete();
        return redirect()->route('admin.majors.index')->with('success', "the major deleted successfuly");
        
    }
}
