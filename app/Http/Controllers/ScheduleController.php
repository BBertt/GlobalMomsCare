<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index() {
        $schedules = Schedule::where('account_id', Auth::id())->with('hospital')->orderBy('date')->get();

        return view('appointments', compact('schedules'));
    }
    public function addAppointments(Request $request) {
        $request->validate([
            'hospital_name' => 'required|string|max:255',
            'hospital_address' => 'required',
            'appointment_date' => 'required|date',
        ]);

        $hospital = Hospital::where('name', $request->hospital_name)
                        ->where('address', $request->hospital_address)->first();

        if (!$hospital) {
            $hospital = Hospital::create([
                'name' => $request->hospital_name,
                'address' => $request->hospital_address,
            ]);
        }

        Schedule::create([
            'account_id' => Auth::id(),
            'hospital_id' => $hospital->id,
            'date' => $request->appointment_date,
        ]);

        return redirect()->back();
    }

    public function deleteAppointments($schedule_id) {
        
        $schedule = Schedule::find($schedule_id);

        // Check if the schedule exists
        if ($schedule) {
            // Delete the schedule
            $schedule->delete();
        }

        $temp = Schedule::where('hospital_id', $schedule->hospital_id)->first();

        if (!$temp) {
            $hospital = Hospital::find($schedule->hospital_id);
            $hospital->delete();
        }

        return redirect()->back();
    }
}
