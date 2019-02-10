<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('allContact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name'    => $request['name'],
            'phone'   => $request['phone'],
            'email'   => $request['email'],
            'religion'=> $request['religion']
        ];
        Contact::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Contact::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->name = $request['name'];
        $contact->phone = $request['phone'];
        $contact->email = $request['email'];
        $contact->religion = $request['religion'];
        $contact->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
    }

    public function Allcontact()
    {
        $contact = Contact::all();

        return Datatables::of($contact)
                ->addColumn('action', function($contact){
                    return '<a onclick="showData('.$contact->id.')" class="btn btn-sm btn-success">View</a>'.''.
                            '<a onclick="editForm('.$contact->id.')" class="btn btn-sm btn-info">Edit</a>'.''.
                            '<a onclick="deleteData('.$contact->id.')" class="btn btn-sm btn-danger">Delete</a>';
                })->make(true);
    }
}
