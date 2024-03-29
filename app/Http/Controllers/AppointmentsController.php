<?php

    // app/Http/Controllers/AppointmentController.php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client2;
use App\Models\Counselor;
use App\Models\Slot;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
 use Twilio\Rest\Client;
use Jubaer\Zoom\Facades\Zoom;
 use Carbon\Carbon;
 
 

class AppointmentsController extends Controller
{
    public function index():View

    {
         $userId = auth()->user()->id;

        // Query the database to fetch appointments associated with the user
         $userAppointments = Appointment::whereHas('client', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->orWhereHas('counselor', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->with('client', 'counselor', 'slot')->get();
        $appointments = Appointment::with('client')->with('counselor')->with('slot')->get();

        return view('appointment.index', compact('appointments','userAppointments'));
    }

    public function create():view
    {
        // Fetch counselors and clients from the database to populate dropdowns in the form
        $counselors = Counselor::with('slots')->get();
        $clients = Client2::all();
      

        return view('appointment.create', compact('counselors', 'clients'));
    }

    public function store(Request $request)
    {
            $slot_id = $request->input('slot_id');
            $time = Slot::where('id', $slot_id)->first()->start_time;
            $date = $request->input('date');
            


            $userTimezone = 'Africa/Nairobi';

            // Get the local start time (you can replace this with your input)
            $localStartTime = $date .'  '. $time;

            // Convert local time to UTC
            $utcStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $localStartTime, $userTimezone)
                ->setTimezone('UTC')
                ->format('Y-m-d\TH:i:s\Z');

            $response = Zoom::createMeeting([
                    "agenda" => 'Counselling appointment',
                    "topic" => 'counselling',
                    "type" => 2, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
                    "duration" => 40, // in minutes
                    "timezone" => 'Africa/Nairobi', //  timezone
                    "password" => 123456789,
                    "start_time" =>$utcStartTime, // set your start time
                    "template_id" => '', // set your template id  Ex: "Dv4YdINdTk+Z5RToadh5ug==" from https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetingtemplates
                    "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
                    "schedule_for" => 'derrickriziki7@gmail.com', // set your schedule for
                    "settings" => [
                        'join_before_host' => false, // if you want to join before host set true otherwise set false
                        'host_video' => false, // if you want to start video when host join set true otherwise set false
                        'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                        'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                        'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                        'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                        'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                        'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
                    ],
                   

                ]);
                    $sid = getenv("TWILIO_SID");
                    $token = getenv("TWILIO_TOKEN");
                    $senderNo = getenv("TWILIO_PHONE");
                    $twilio = new Client($sid, $token);

                    $message = $twilio->messages
                                    ->create("+254791755980", // to
                                            [
                                                "body" => "Thank you for booking, your session starts at:" . $localStartTime  ." ". "Session Link:". $response['data']['join_url'],
                                                "from" => $senderNo
                                            ]
                                    );
                                    
                               
                                    
                $json = $response['data']['join_url'];
                

                $appointment = Appointment::create([
                    'client_id' => $request->input('client_id'),
                    'counselor_id' => $request->input('counselor_id'),
                    'slot_id' => $request->input('slot_id'),
                    'link'=>$json,
                    'status' => 'pending',
            
              ]);

       

            return redirect('appointment')->with('success', 'Appointment booked successfully.');
    }

   
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
    
    public function destroy(Request $request ,$id)

    {
       
        $appointment = Appointment::find( $id);
        $appointment ->delete();
          return redirect('appointment')->with('success', 'Appointment Deleted!!');


    }
}


  

