<?php

namespace App\Http\Controllers\API\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ContactUsRequest;
use App\Http\Traits\ApiTrait;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;

class ContactController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string'],

        ]);

        if($validator->fails()){
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }

        $contact = Contact::create([
            'name'=>$request['name'],
            'phone' =>$request['phone'],
            'email' => $request['email'],
            'message'=> $request['message']
        ]);

        return $this->apiResponse(201, 'Doctor created', 'null', $contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
