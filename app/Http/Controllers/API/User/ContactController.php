<?php

namespace App\Http\Controllers\API\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ContactUsRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('User.Pages.Contact.create');
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
    public function store(ContactUsRequest $request)
    {
        $data = $request->validated();

        Contact::create([
            'name'=>$data['name'],
            'phone' =>$data['phone'],
            'email' => $data['email'],
            'message'=> $data['message']
        ]);

        return view('User.Pages.Contact.create')->with('success','message sent successfuly , thank you');
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
