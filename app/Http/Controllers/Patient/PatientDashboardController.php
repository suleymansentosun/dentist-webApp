<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use Carbon\Carbon;

class PatientDashboardController extends Controller
{
    public function showDashboard(Request $request)
    {
        $bookingsBelongToThePatient = Booking::where('user_id', $request->user()->id)->get();

        return view('patients.dashboard.index')
            ->with('bookingsBelongToThePatient', $bookingsBelongToThePatient);
    }
}
