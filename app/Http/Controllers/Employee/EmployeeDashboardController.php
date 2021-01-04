<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class EmployeeDashboardController extends Controller
{
    public function showDashboard()
    {
        $response = Gate::inspect('view-employee-dashboard');

        if ($response->allowed()) {
            $bookings = Booking::whereDate('booking_date', Carbon::today())->get();
        
            return view('employees.dashboard.index')
                ->with('bookings', $bookings);
        } else {
            echo $response->message();
        }
    }

    public function getTodaysBookings()
    {
        $todaysBookings = Booking::whereDate('booking_date', Carbon::today())->paginate(10);

        return view('bookings.index')
        ->with('bookings', $todaysBookings);
    }
}
