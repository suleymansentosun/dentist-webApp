<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Booking;
use App\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
    public function showDashboard(Request $request)
    {
        $doctor = Doctor::where('user_id', $request->user()->id)->get();        
        $bookings = Booking::whereDate('booking_date', Carbon::today())->where([
            ['doctor_id', $doctor[0]->id],
            ['is_materialized', null]
        ])->get();
        $today = Carbon::today();
        return view('doctors.dashboard.index')
            ->with('bookings', $bookings)
            ->with('doctor_id', $doctor[0]->id)
            ->with('today', $today);
    }

    public function showBookingsOfDoctor(Request $request, $id, $booking_date = null)
    {
        if (is_null($booking_date)) {
            $bookings = Booking::where('doctor_id', $id)->paginate(10);
        } else {
            $bookings = Booking::whereDate('booking_date', $booking_date)->where('doctor_id', $id)->paginate(10);
        }
        return view('bookings.index')
            ->with('bookings', $bookings);
    }
}
