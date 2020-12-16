<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\BookingReason;
use App\Booking;
use App\Doctor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class FirstStageOfBookingController extends Controller
{
    public function returnBookingReasons()
    {
        $bookingReasons = BookingReason::all();

        $bookingReasonsArray = array();

        foreach($bookingReasons as $bookingReason) {
            array_push($bookingReasonsArray, [$bookingReason->id, $bookingReason->name]);
        }

        array_unshift($bookingReasonsArray, [0, 'Seçiniz']);

        return response()->json($bookingReasonsArray);
    }

    public function returnRelatedDoctorInfos($bookingReasonId, $doctorIdToBeViewedAtTheTop)
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
                    $query->where('name', '=', 'Estetik Diş Hekimliği');
                })->get();
                break;
            case 3:
                $doctors = Doctor::all();
                break;
            case 4:
                $doctors = Doctor::whereHas('specialties', function (Builder $query) {
                    $query->where('name', '=', 'İmplantoloji');
                })->get();
                break;
            case 5:
                $doctors = Doctor::all();
                break;
        }

        if ($doctorIdToBeViewedAtTheTop != 0) {
            $doctors = $doctors->sortBy(function ($doctor, $key) use ($doctorIdToBeViewedAtTheTop) {
                // dd($doctorIdToBeViewedAtTheTop);
                return abs($doctor['id'] - $doctorIdToBeViewedAtTheTop);
            });
        }

        // dd($doctors);

        $doctorInfos = array();

        foreach ($doctors as $doctor) {
            $doctorSpecialties = array();
            foreach($doctor->specialties as $specialty) {
                array_push($doctorSpecialties, $specialty->name);
            }

            array_push($doctorInfos, ["name" => $doctor->name, "surname" => $doctor->surname, 
            "id" => $doctor->id, "specialties" => $doctorSpecialties,"profile_picture" => $doctor->profile_picture]);
        }

        return response()->json($doctorInfos);
    }

    public function returnAvailableBookingsForRelatedDoctors($doctorIds, $currentDatesOnBookingCalendar)
    {
        // [[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]],[[],[],[]]]
        $stateOfBookingTimesForAllDoctorsAndAllDays = [];
        $stateOfBookingTimesForAllDoctorsForOneDay = [];

        $doctorIds = json_decode($doctorIds);
        $currentDatesOnBookingCalendar = json_decode($currentDatesOnBookingCalendar);

        $allBookingHoursWithinWorkingHours = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

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
