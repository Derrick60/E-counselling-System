<?php

namespace App\Http\Controllers;

use App\Models\Counselor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CounselorController extends Controller
{
    public function index()
    {
       return  view('counselor.index');
    }
    public function fetch()
    {
        // Fetch counselors and clients from the database to populate dropdowns in the form
        $counselor = Counselor::with('user')->get();
        return  view('counselor.index', compact('counselor'));
    }
    public function show()
    {
        $User = User::all();
        return view('counselor.create', compact('User'));
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(),[

            'user_id' => 'required|unique:counselors,user_id',
            'name' => 'required|unique:counselors,name',
             'phone' => 'required|unique:counselors,phone',
              'email' => 'required|unique:counselors,email'
         ]);
        
        // Validation logic goes here

        $counselor = Counselor::create([
            'user_id'=>$request->input('user_id'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
            
            
            
        ]);
         if($validator-> fails()){
               
                return view('counselor.create')->with('error',$validator->messages());  
         } else{
            return redirect('/counselor')->with('success', 'saved successfully.');

        }
        // Notify the client or counselor about the appointment (implement notifications)

       
    }
     public function edit(Request $request,$id)
    {
        $counselors = Counselor::findOrFail($id);
        if($counselors){
            return view('counselor.edit')->with('counselors',$counselors);

        }
        else{
           
        }

    }
      public function update(Request $request ,$id)
    {
       
    $validator = Validator::make($request->all(),[

            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10',
            'email' => 'required|email|max:255|unique:counselors,email,' . $id, // Ensure email is unique, excluding the current counselor
         ]);
         
        if($validator-> fails()){
               
                return redirect('counselor')->with('error',$validator->messages());  
         } else{
            $counselor=Counselor::findOrFail($id);
         $counselor ->update([
            'user_id'=>$request->input('user_id'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);
           return redirect('counselor')->with('success','updated successfuly');

        }
        

        }
         public function destroy(Request $request ,$id)
    {
        $counselor = Counselor::findOrFail($id);
        $counselor->delete();
         return response()->json(['success'=>'successful']);
      
    }
}
