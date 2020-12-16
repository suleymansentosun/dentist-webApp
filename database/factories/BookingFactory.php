<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookingReason;
use App\Doctor;
use App\Booking;
use App\Patient;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Builder;

$factory->define(Booking::class, function (Faker $faker) {
    $bookingReasonIds = array();
    foreach(BookingReason::all() as $bookingReason) {
        array_push($bookingReasonIds, $bookingReason->id);
    }

    $doctorIds = array();
    foreach(Doctor::all() as $doctor) {
        array_push($doctorIds, $doctor->id);
    }

    $userIds = array();

    $userWithEmployeeRole = User::whereHas('roles', function(Builder $query) {
        $query->where('name', '=', 'Employee');
    })->get();

    foreach($userWithEmployeeRole as $user) {
        array_push($userIds, $user->id);
    }

    $patientIds = array();
    foreach(Patient::all() as $patient) {
        array_push($patientIds, $patient->id);
    }

    $bookingIds = array();
    foreach(Booking::all() as $booking) {
        array_push($bookingIds, $booking->id);
    }

    if (count($userIds) > 0 && rand(0, 1)) {
        $currentUserId = $userIds[array_rand($userIds, 1)];
    }

    if (count($patientIds) > 0 && rand(0, 4)) {
        $currentPatientId = $patientIds[array_rand($patientIds, 1)];
    }

    if (rand(0, 4)) {
        $heads = true;
    }

    $array = array();

    $array['user_id'] = isset($currentUserId) ? $currentUserId : factory(App\User::class);
    $array['patient_id'] = isset($currentPatientId) ? $currentPatientId : factory(App\Patient::class);
    $array['bookingReason_id'] = $bookingReasonIds[array_rand($bookingReasonIds, 1)];
    $array['doctor_id'] = $doctorIds[array_rand($doctorIds, 1)];
    // $array['booking_date'] = $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 month');
    $dt = new Carbon($faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 month'));
    $array['booking_date'] = $dt->startOfHour();

    if (Carbon::parse($array['booking_date'])->hour > 17) {
        $array['booking_date'] = Carbon::parse($array['booking_date'])->subHours(rand(6,9));
        // 18 19 20 21 22 23 0 01 02 03 04 05 06 07 08
    } elseif(Carbon::parse($array['booking_date'])->hour < 9) {
        $array['booking_date'] = Carbon::parse($array['booking_date'])->addHours(9);
    }

    if (strtotime('-30 minutes') > strtotime($array['booking_date']->format('Y-m-d H:i:s'))) {
        $array['is_finalized'] = true;
        $array['is_notificated'] = true;
        if (isset($heads)) {
            $array['is_materialized'] = true;
        } else {
            $array['is_materialized'] = false;
        }
    } else {
        $array['is_materialized'] = null;
        $array['is_notificated'] = null;
        $array['is_finalized'] = null;
    }

    $array['hasMaterializedBookingBefore'] = false;

    return $array;
});

$factory->afterCreating(App\Booking::class, function ($booking, $faker) {
    $patientIdsOfMaterializedBookingsBeforeThisBooking = array();

    $materializedBookingsBeforeThisBooking = Booking::where('is_materialized', '=', true)
    ->whereDate('booking_date', '<', $booking->booking_date)->get();

    if (count($materializedBookingsBeforeThisBooking) > 0) {
        foreach($materializedBookingsBeforeThisBooking as $bookng) {
            array_push($patientIdsOfMaterializedBookingsBeforeThisBooking, $bookng->patient_id);
        }
    } else {
        $booking->hasMaterializedBookingBefore = false;
        $booking->save();
    }

    if (in_array($booking->patient_id, $patientIdsOfMaterializedBookingsBeforeThisBooking)) {
        $booking->hasMaterializedBookingBefore = true;
        $booking->save();
    } else {
        $booking->hasMaterializedBookingBefore = false;
        $booking->save();
    }
});
