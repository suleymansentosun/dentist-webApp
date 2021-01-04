<?php

namespace App\Http\Middleware;

use Closure;
use App\Booking;
use Session;

class CheckBookingDateAndTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        preg_match('/[0-9]+/', $request->url(), $output_array);

        $booking = Booking::find($output_array[0]);

        if (strtotime($booking->booking_date) > strtotime('now')) {
            return $next($request);
        } else {
            Session::flash('error', "Past bookings cannot be updated!");
            return redirect()->back();
        }
    }
}
