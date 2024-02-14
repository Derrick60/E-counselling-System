<?php

    // app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Counselor;
use App\Models\Slot;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index():View
    {
        $appointments = Appointment::with('client')->with('counselor')->with('slot')->get();

        return view('appointment.index', compact('appointments'));
    }

    public function create():view
    {
        // Fetch counselors and clients from the database to populate dropdowns in the form
        $counselors = Counselor::with('slots')->get();
        $clients = Client::all();
      

        return view('appointment.create', compact('counselors', 'clients'));
    }

    public function store(Request $request)
    {
        // Validation logic goes here

        $appointment = Appointment::create([
            'client_id' => $request->input('client_id'),
            'counselor_id' => $request->input('counselor_id'),
            'slot_id' => $request->input('slot_id'),
            'end_time' => $request->input('end_time'),
            'status' => 'pending',
            
        ]);

        // Notify the client or counselor about the appointment (implement notifications)

        return redirect('appointment')->with('success', 'Appointment booked successfully.');
    }

    // Implement other CRUD methods (show, edit, update, destroy) as needed
    public function availableSlots(Request $request ,$date ,$counselor){

        $date1 = new DateTime($date);
         $day = $date1->format('l');
        
        // Get all slots
        $allSlots = Slot::where('day',$day)->get();

        // Get booked slots
        $bookedSlots = Appointment::pluck('slot_id');

        // Filter available slots
        $availableSlots = $allSlots->filter(function ($slot) use ($bookedSlots) {
            return !in_array($slot->id, $bookedSlots->toArray());
        });

       
        return response()->json(['availableSlots'=>$availableSlots]);
       

    }
}


  

