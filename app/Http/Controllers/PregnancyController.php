<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PregnancyController extends Controller
{
    public function calculatePregnancy(Request $request) {
        $request->validate([
            'last_period' => 'required|date',
        ]);

        // Parse the input last period date
        $lastPeriod = Carbon::parse($request->last_period);

        // Calculate the due date (40 weeks from LMP)
        $dueDate = $lastPeriod->copy()->addWeeks(40);

        // Get the current date
        $currentDate = Carbon::now();

        // Calculate the pregnancy stage in days
        $pregnancyStageInDays = $lastPeriod->diffInDays($currentDate);

        // Ensure that the pregnancy stage is not beyond 40 weeks or negative
        if ($pregnancyStageInDays < 0 || $pregnancyStageInDays > 280) { // 280 days = 40 weeks
            return redirect()->back()->withErrors(['last_period' => 'Invalid date: Pregnancy should be within 40 weeks.']);
        }

        // Convert days to weeks and days
        $pregnancyWeeks = intdiv($pregnancyStageInDays, 7); // Total full weeks
        $pregnancyDays = $pregnancyStageInDays % 7;         // Remaining days

        // Pass calculated values to the view
        return view('pregnancy-calendar', compact('dueDate', 'pregnancyWeeks', 'pregnancyDays'));
    }
}

