<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Hospital;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    // Show appointments page with all the appointments.
    public function index() {
        $schedules = Schedule::where('account_id', Auth::id())->with('account', 'professional')->orderBy('date')->get();
        $account = Account::where('id', Auth::id())->first();
        $professionals = Account::where('role', 'professional')->get();
        return view('appointments.index', compact('schedules', 'account', 'professionals'));
    }

    // Add new Appointments.
    public function addAppointments(Request $request) {
        $request->validate([
            'doctor' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:now',
        ]);

        Schedule::create([
            'account_id' => Auth::id(),
            'professional_id' => $request->doctor,
            'reason' => $request->reason,
            'status' => 'Pending',
            'date' => $request->appointment_date,
        ]);

        return redirect()->back();
    }

    // Delete Appointments.
    public function deleteAppointments($schedule_id) {

        $schedule = Schedule::find($schedule_id);

        if ($schedule) {
            $schedule->delete();
        }

        return redirect()->back();
    }
}
