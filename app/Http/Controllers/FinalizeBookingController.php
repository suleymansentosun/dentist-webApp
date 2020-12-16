<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Booking;
use App\Patient;
use App\User;

class FinalizeBookingController extends Controller
{
    public function notificateToFront()
    {
        $bookings = Booking::all();
            
        foreach($bookings as $item => $booking) {
            if (
                (strtotime('-30 minutes') > strtotime($booking->booking_date)) 
                && 
                $booking->is_notificated != true
                && 
                $booking->is_finalized != true
            ) {
                $booking->is_notificated = true;
                $booking->save();
            }
        }

        $bookingsToBeNotified = Booking::where([
            ['is_notificated', '=', true],
            ['is_finalized', '=', null],
        ])->get();

        // dd($bookingsToBeNotified);

        $patientsOfbookingsToBeNotified = [];

        foreach($bookingsToBeNotified as $booking) {
            array_push($patientsOfbookingsToBeNotified, [$booking->patient, $booking]);
        }

        return response()->json($patientsOfbookingsToBeNotified);
    }

    public function finalizeAndUpdateBooking(Request $request)
    {       
        $notifiedBookings = Booking::where([
            ['is_notificated', '=', true],
            ['is_finalized', '=', null],
        ])->get();

        $toBeDeletedPatients = [];

        foreach($notifiedBookings as $item => $booking) {
            if ($request->input($booking->id) == 'yes') {
                $booking->is_finalized = true;
                $booking->is_materialized = true;
                $booking->patient->is_certain = true;
                $booking->save();
                $booking->patient->save();
            } elseif ($request->input($booking->id) == 'no') {
                $booking->is_finalized = true;
                $booking->is_materialized = false;
                array_push($toBeDeletedPatients, $booking->patient);
                $booking->patient_id = null;
                $booking->save();
            } 
        }

        $this->delete($toBeDeletedPatients);
        return redirect()->action('HomeController@index');
    }

    public function delete($patients)
    {
        foreach($patients as $item => $patient) {
            $patient->delete();
            $patient->users()->detach();
            $patient->doctors()->detach();
        }
    }
}
