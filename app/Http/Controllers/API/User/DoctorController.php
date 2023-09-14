<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        if(!$id){
            $doctors = Doctor::with('major')->get();
            return $this->apiResponse(200, 'All Doctors', 'null', $doctors);
        }else{
            $doctors = Doctor::with('major')->where('major_id','=',$id)->get();
            return $this->apiResponse(200, 'All Doctors', 'null', $doctors);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
