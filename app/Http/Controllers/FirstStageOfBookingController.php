<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\BookingReason;
use App\Booking;
use App\Doctor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\URL;

class FirstStageOfBookingController extends Controller
{
    public function returnBookingReasons()
    {
        $currentUrl = URL::current();
        $urlSegments = explode('/', trim($currentUrl, '/'));
        $lang = $urlSegments[3];

        $bookingReasons = BookingReason::all();

        $bookingReasonsArray = array();

        foreach($bookingReasons as $bookingReason) {            
            array_push($bookingReasonsArray, [$bookingReason->id, $lang == 'tr' ? $bookingReason->name : $bookingReason->nameEn]);
        }

        if ($lang == 'tr') {
            array_unshift($bookingReasonsArray, [0, 'Seçiniz']);
        } else if ($lang == 'en') {
            array_unshift($bookingReasonsArray, [0, 'Select']);
        } else {
            array_unshift($bookingReasonsArray, [0, 'Select']);
        }

        return response()->json($bookingReasonsArray);
    }

    public function returnRelatedDoctorInfos($lang, $bookingReasonId, $doctorIdToBeViewedAtTheTop)
    {
        switch ($bookingReasonId) {
            case 0:
                $doctors = Doctor::all();
                break;
            case 1:
                $doctors = Doctor::all();
                break;
            case 2:
                $doctors = Doctor::whereHas('specialties', function (Builder $query) {
                    $query->where('specialties.id', '=', 2);
                })->get();
                break;
            case 3:
                $doctors = Doctor::all();
                break;
            case 4:
                $doctors = Doctor::whereHas('specialties', function (Builder $query) {
                    $query->where('specialties.id', '=', 1);
                })->get();
                break;
            case 5:
                $doctors = Doctor::all();
                break;
        }

        if ($doctorIdToBeViewedAtTheTop != 0) {
            $doctors = $doctors->sortBy(function ($doctor, $key) use ($doctorIdToBeViewedAtTheTop) {
                return abs($doctor['id'] - $doctorIdToBeViewedAtTheTop);
            });
        }

        $doctorInfos = array();

        foreach ($doctors as $doctor) {
            $doctorSpecialties = array();

            if ($lang == 'tr') {
                foreach($doctor->specialties as $specialty) {
                    array_push($doctorSpecialties, $specialty->name);
                }
            } else if ($lang == 'en') {
                foreach($doctor->specialties as $specialty) {
                    array_push($doctorSpecialties, $specialty->nameEn);
                }
            } else {
                foreach($doctor->specialties as $specialty) {
                    array_push($doctorSpecialties, $specialty->nameEn);
                }
            }

            array_push($doctorInfos, ["name" => $doctor->name, "surname" => $doctor->surname, 
            "id" => $doctor->id, "specialties" => $doctorSpecialties,"profile_picture" => $doctor->profile_picture]);
        }

        return response()->json($doctorInfos);
    }

    public function returnAvailableBookingsForRelatedDoctors($lang, $doctorIds, $currentDatesOnBookingCalendar)
    {
        // [[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]]]
        $stateOfBookingTimesForAllDoctorsAndAllDays = [];
        $stateOfBookingTimesForAllDoctorsForOneDay = [];

        $doctorIds = json_decode($doctorIds);
        $currentDatesOnBookingCalendar = json_decode($currentDatesOnBookingCalendar);

        $allBookingHoursWithinWorkingHours = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

        // dd($currentDatesOnBookingCalendar);

        foreach ($currentDatesOnBookingCalendar as $date) {
            foreach ($doctorIds as $doctorId) {
                $stateOfBookingTimesForOneDoctorForOneDay = [];

                $bookingsForDoctor = Booking::whereDate('booking_date', $date)->where('doctor_id', $doctorId)->get();
                $notAvailableHours = array();

                // dd($bookingsForDoctor);

                foreach ($bookingsForDoctor as $booking) {
                    $dt = Carbon::parse($booking->booking_date);
                    array_push($notAvailableHours, $dt->format('H:i'));
                }

                // $stateOfBookingTimesForOneDoctorForOneDay = array_diff($allBookingHoursWithinWorkingHours, $notAvailableHours);
                for ($i = 0; $i < count($allBookingHoursWithinWorkingHours); $i++) {
                    if (in_array($allBookingHoursWithinWorkingHours[$i], $notAvailableHours)) {
                        array_push($stateOfBookingTimesForOneDoctorForOneDay, 'Dolu' . $allBookingHoursWithinWorkingHours[$i]);
                    } else {
                        array_push($stateOfBookingTimesForOneDoctorForOneDay, $allBookingHoursWithinWorkingHours[$i]);
                    }
                }

                array_push($stateOfBookingTimesForAllDoctorsForOneDay, $stateOfBookingTimesForOneDoctorForOneDay);
            }
            array_push($stateOfBookingTimesForAllDoctorsAndAllDays, $stateOfBookingTimesForAllDoctorsForOneDay);
            $stateOfBookingTimesForAllDoctorsForOneDay = [];
        }

        return response()->json($stateOfBookingTimesForAllDoctorsAndAllDays);
    }
}
