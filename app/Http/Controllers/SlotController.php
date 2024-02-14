<?php

namespace App\Http\Controllers;

use App\Models\Counselor;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index()
    {
        return view('slot.index');
    }
    public function fetch()
    {
        $slots = Slot::with('counselor')->get();
        // dd($slot);
        return view('slot.index',compact('slots'));
    }
    public function show()
    {
        return view('slot.create');
    }
    public function create()
    {
    

        $counselors = Counselor::all('*');
        return view('slot.create', compact('counselors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'counselor_id' => 'required',
            'day' => 'required',
        ]);

        $counselorId = $request->input('counselor_id');
        $day =  $request->input('day');

        // Define tea break and lunch break intervals
        $teaBreakStart = Carbon::createFromTime(10, 30);
        $teaBreakEnd = Carbon::createFromTime(11, 0);
        $lunchBreakStart = Carbon::createFromTime(13, 0);
        $lunchBreakEnd = Carbon::createFromTime(13, 30);

        $startTime = Carbon::createFromTime(9, 0);
        $endTime = $startTime->copy()->addMinutes(40);

        while ($endTime->lte(Carbon::createFromTime(17, 0))) {
            // Check if the slot overlaps with breaks
            if ($this->isSlotOverlappingBreak($startTime, $endTime, $teaBreakStart, $teaBreakEnd) ||
                $this->isSlotOverlappingBreak($startTime, $endTime, $lunchBreakStart, $lunchBreakEnd)) {
                // Skip this slot if it overlaps with a break
                $startTime->addMinutes(40);
                $endTime->addMinutes(40);
                continue;
            }

            // Save the slot
            Slot::create([
                'start_time' => $startTime,
                'end_time' => $endTime,
                'counselor_id' => $counselorId,
                'day' => $day,
            ]);

            // Move to the next slot
            $startTime->addMinutes(40);
            $endTime->addMinutes(40);
        }

        return redirect('slot-create')->with('success', 'Slots created successfully.');
    }
protected function isSlotOverlappingBreak($slotStartTime, $slotEndTime, $breakStartTime, $breakEndTime)
    {
        return $slotStartTime < $breakEndTime && $slotEndTime > $breakStartTime;
    }
   
}


