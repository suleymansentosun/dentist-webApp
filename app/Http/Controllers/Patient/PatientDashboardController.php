<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class PatientDashboardController extends Controller
{
    public function showDashboard(Request $request)
    {
        $response = Gate::inspect('view-patient-dashboard');

        if ($response->allowed()) {
            $bookingsBelongToThePatient = Booking::where('user_id', $request->user()->id)->get();

            return view('patients.dashboard.index')
                ->with('bookingsBelongToThePatient', $bookingsBelongToThePatient);
        } else {
            echo $response->message();
        }
    }
}
