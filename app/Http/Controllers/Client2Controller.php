<?php

namespace App\Http\Controllers;

use App\Models\Client2;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class Client2Controller extends Controller
{
    public function index()
    {
       return  view('client.index');
    }
    public function fetch()
    {
         $userId = auth()->user()->id;
       $clientLoged = Client2::where('user_id',$userId)->get();
      $client = Client2::all();
        return  view('client.index', compact('client','clientLoged'));

    }
     public function show()
    {
        
       $User = User::all();
        return view('client.create', compact('User'));
       
    }
   

    public function store(Request $request)
    {
        // Validation logic goes here

        $client = Client2::create([
            'user_id'=>$request->input('user_id'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
             'regNo' => $request->input('regNo'),
            
            
        ]);

        // Notify the client or counselor about the appointment (implement notifications)
        return redirect('/client')->with(['status'=>'success','statusCode'=>'success']);
    }
     function edit(Request $reques, $id )
     {
        $clients = Client2::find($id);
       return view('client.edit')->with('clients',$clients);
      
    }
    function update(Request $request, $id )
     {
         $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'phone' => 'required|max:199',
            'email' => 'required|max:199',
           
            
  
             ]);
             if($validator-> fails()){
               
                return response()->json([
                    'status'=>'error',
                    'errors' =>$validator->messages()
                    
                    
                ]);
            }
        // Retrieve the client by ID
        $client = Client2::findOrFail($id);
        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->update();
        return response()->json(['status'=>'success', 'statusCode'=>'success', 'message' => 'Client updated successfully'], 200);
    }
                
                          
                        
                    
        


    public function destroy(Request $request ,$id)

    {
        $client = Client2::find($id);
        $client ->delete();
           return response()->json([
                'status'=>'success','statusCode'=>'success'
            ]);

    }
}
