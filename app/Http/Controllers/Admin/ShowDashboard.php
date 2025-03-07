<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Booking;
use App\User;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class ShowDashboard extends Controller
{
    /**
     * Show the application admin dashboard.
     */
    public function showDashboard()
    {
        $response = Gate::inspect('view-admin-dashboard');

        if ($response->allowed()) {
            $bookings = Booking::whereDate('created_at', Carbon::today())->get();

            $matchThese = ['is_materialized' => 1, 'hasMaterializedBookingBefore' => 0];
            $registeredPatientsForTheFirstTime = Booking::whereDate('booking_date', Carbon::today())->where($matchThese)->get();
            
            $users = User::whereDate('created_at', Carbon::today())->get();
    
            return view('admin.dashboard.index')
                ->with('bookings', $bookings)
                ->with('registeredPatientsForTheFirstTime', $registeredPatientsForTheFirstTime)
                ->with('users', $users);
        } else {
            echo $response->message();
        }
    }
}
