<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
       return  view('client.index');
    }
    public function fetch()
    {
        // Fetch counselors and clients from the database to populate dropdowns in the form
        $client = Client::all();
       return  view('client.index', compact('client'));

    }
    public function show()
    {
        // Fetch counselors and clients from the database to populate dropdowns in the form
       return  view('client.create');
       
    }

    public function store(Request $request)
    {
        // Validation logic goes here

        $client = Client::create([
            'user_id'=>$request->input('user_id'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
             'regNo' => $request->input('regNo'),
            
            
        ]);

        // Notify the client or counselor about the appointment (implement notifications)

        return redirect('/client')->with('success', 'saved successfully.');
    }
}
