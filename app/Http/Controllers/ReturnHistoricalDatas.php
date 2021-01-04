<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use App\User;
use App\Doctor;
use App\Helpers\DateAndDataMatcher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class ReturnHistoricalDatas extends Controller
{
    public function returnHistoricalDatas(Request $request)
    {
        $response = Gate::inspect('view-historical-datas');

        if ($response->allowed()) {
            $dateAndDataMatcher = new DateAndDataMatcher();

            $dataList = array();
            $previousDates;
    
            $plainPath = $request->segment(2);
            // dd($plainPath);
    
            switch ($plainPath) {
                case 'getDailyBookingDatas':
                    // dd('Buraya girdi');
                    for ($i = 30; $i >= 0; $i--) {
                        $bookings = Booking::materialized()->whereDate('booking_date', Carbon::today()->subDays($i))->get();
                        $averageCountOfBookings = calculateAverageCountOfBookings(Carbon::today()->startOfDay()->subDays($i), 'day', 30);
                        array_push($dataList, [count($bookings), $averageCountOfBookings]);
                        $previousDates = $dateAndDataMatcher->getPreviousDays(Carbon::now(), 30);
                    }
                    break;
                case 'getDailyPatientDatas':
                    for ($i = 30; $i >= 0; $i--) {
                        $patients = Booking::newPatient()->whereDate('booking_date', Carbon::today()->subDays($i))->get();
                        $averageCountOfPatients = calculateAverageCountOfPatients(Carbon::today()->startOfDay()->subDays($i), 'day', 30);
                        array_push($dataList, [count($patients), $averageCountOfPatients]);
                        $previousDates = $dateAndDataMatcher->getPreviousDays(Carbon::now(), 30);
                    }
                    break;
                case 'getWeeklyBookingDatas':
                    for ($i = 20; $i >= 0; $i--) {
                        $startOfWeek = Carbon::now()->startOfWeek()->subWeeks($i);
                        $endOfWeek = Carbon::now()->endOfWeek()->subWeeks($i);
                        $bookings = Booking::OfPeriod(date($startOfWeek), date($endOfWeek))->materialized()->get();
                        $averageCountOfBookings = calculateAverageCountOfBookings(Carbon::today()->startOfWeek()->subWeeks($i), 'week', 20);
                        array_push($dataList, [count($bookings), $averageCountOfBookings]);
                        $previousDates = $dateAndDataMatcher->getPreviousWeeks(Carbon::now(), 20);
                    }
                    break;
                case 'getWeeklyPatientDatas':
                    for ($i = 20; $i >= 0; $i--) {
                        $startOfWeek = Carbon::now()->startOfWeek()->subWeeks($i);
                        $endOfWeek = Carbon::now()->endOfWeek()->subWeeks($i);
                        $patients = Booking::newPatient()->OfPeriod(date($startOfWeek), date($endOfWeek))->get();
                        $averageCountOfPatients = calculateAverageCountOfPatients(Carbon::today()->startOfWeek()->subWeeks($i), 'week', 20);
                        array_push($dataList, [count($patients), $averageCountOfPatients]);
                        $previousDates = $dateAndDataMatcher->getPreviousWeeks(Carbon::now(), 20);
                    }
                    break;
                case 'getMonthlyBookingDatas':
                    for ($i = 10; $i >= 0; $i--) {
                        $startOfMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
                        $endOfMonth = Carbon::now()->endOfMonth()->subMonthsNoOverflow($i);
                        $bookings = Booking::OfPeriod(date($startOfMonth), date($endOfMonth))->materialized()->get();
                        $averageCountOfBookings = calculateAverageCountOfBookings($startOfMonth, 'month', 10);
                        array_push($dataList, [count($bookings), $averageCountOfBookings]);
                        $previousDates = $dateAndDataMatcher->getPreviousMonths(Carbon::now(), 10);
                    }
                    break;
                case 'getMonthlyPatientDatas':
                    for ($i = 10; $i >= 0; $i--) {
                        $startOfMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
                        $endOfMonth = Carbon::now()->endOfMonth()->subMonthsNoOverflow($i);
                        $patients = Booking::newPatient()->OfPeriod(date($startOfMonth), date($endOfMonth))->get();
                        $averageCountOfPatients = calculateAverageCountOfPatients($startOfMonth, 'month', 10);
                        array_push($dataList, [count($patients), $averageCountOfPatients]);
                        $previousDates = $dateAndDataMatcher->getPreviousMonths(Carbon::now(), 10);
                    }
                    break;
                case 'getWeeklyInstrumentalFactorsInFindingDentist':
                   for ($i = 20; $i >= 0; $i--) {
                       $startOfWeek = Carbon::now()->startOfWeek()->subWeeks($i);
                       $endOfWeek = Carbon::now()->endOfWeek()->subWeeks($i);
                       $webSearch = User::createdDatePeriod(date($startOfWeek), date($endOfWeek))->instrumentalFactorInFinding('web_search')->get();
                       $advice = User::createdDatePeriod(date($startOfWeek), date($endOfWeek))->instrumentalFactorInFinding('advice')->get();
                       $socialMedia = User::createdDatePeriod(date($startOfWeek), date($endOfWeek))->instrumentalFactorInFinding('social_media')->get();
                       $location = User::createdDatePeriod(date($startOfWeek), date($endOfWeek))->instrumentalFactorInFinding('location')->get();
                       $total = count($webSearch) + count($advice) + count($socialMedia) + count($location);
                       array_push($dataList, [calculatePercentage(count($webSearch), $total), 
                       calculatePercentage(count($advice), $total),
                       calculatePercentage(count($socialMedia), $total), 
                       calculatePercentage(count($location), $total)]);
                       // Alttaki satırın dışarıda olması lazım sanki !
                       $previousDates = $dateAndDataMatcher->getPreviousWeeks(Carbon::now(), 20);
                   }
                   break;
                case 'getMonthlyInstrumentalFactorsInFindingDentist':
                    for ($i = 10; $i >= 0; $i--) {
                        $startOfMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
                        $endOfMonth = Carbon::now()->endOfMonth()->subMonthsNoOverflow($i);
                        $webSearch = User::createdDatePeriod(date($startOfMonth), date($endOfMonth))->instrumentalFactorInFinding('web_search')->get();
                        $advice = User::createdDatePeriod(date($startOfMonth), date($endOfMonth))->instrumentalFactorInFinding('advice')->get();
                        $socialMedia = User::createdDatePeriod(date($startOfMonth), date($endOfMonth))->instrumentalFactorInFinding('social_media')->get();
                        $location = User::createdDatePeriod(date($startOfMonth), date($endOfMonth))->instrumentalFactorInFinding('location')->get();
                        $total = count($webSearch) + count($advice) + count($socialMedia) + count($location);
                        array_push($dataList, [calculatePercentage(count($webSearch), $total), 
                        calculatePercentage(count($advice), $total),
                        calculatePercentage(count($socialMedia), $total), 
                        calculatePercentage(count($location), $total)]);
                        $previousDates = $dateAndDataMatcher->getPreviousMonths(Carbon::now(), 10);
                    }
                    break;
                case 'getInstrumentalFactorsInFindingDentistLastTwentyWeeks':
                    $startOfPeriod = Carbon::now()->startOfWeek()->subWeeks(20);
                    $endOfPeriod = Carbon::now()->endOfWeek();
                    $webSearch = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('web_search')->get();
                    $advice = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('advice')->get();
                    $socialMedia = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('social_media')->get();
                    $location = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('location')->get();
                    array_push($dataList, count($webSearch), count($advice), count($socialMedia), count($location));
                    return response()->json($dataList);
                    break;
                case 'getInstrumentalFactorsInFindingDentistLastTenMonths':
                    $startOfPeriod = Carbon::now()->startOfMonth()->subMonthsNoOverflow(10);
                    $endOfPeriod = Carbon::now()->endOfMonth();
                    $webSearch = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('web_search')->get();
                    $advice = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('advice')->get();
                    $socialMedia = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('social_media')->get();
                    $location = User::createdDatePeriod(date($startOfPeriod), date($endOfPeriod))->instrumentalFactorInFinding('location')->get();
                    array_push($dataList, count($webSearch), count($advice), count($socialMedia), count($location));
                    return response()->json($dataList);
                    break;
                case 'getBookingReasonsCountsLastTwentyWeeks':
                    $startOfPeriod = Carbon::now()->startOfWeek()->subWeeks(20);
                    $endOfPeriod = Carbon::now()->endOfWeek();
                    $tootache = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(1)->get();
                    $cosmetic = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(2)->get();
                    $consultation = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(3)->get();
                    $cavities = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(4)->get();
                    array_push($dataList, count($tootache), count($cosmetic), count($consultation), count($cavities));
                    return response()->json($dataList);
                    break;
                case 'getBookingReasonsCountsLastTenMonths':
                    $startOfPeriod = Carbon::now()->startOfMonth()->subMonthsNoOverflow(10);
                    $endOfPeriod = Carbon::now()->endOfMonth();
                    $tootache = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(1)->get();
                    $cosmetic = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(2)->get();
                    $consultation = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(3)->get();
                    $cavities = Booking::OfPeriod(date($startOfPeriod), date($endOfPeriod))->materialized()->bookingReason(4)->get();
                    array_push($dataList, count($tootache), count($cosmetic), count($consultation), count($cavities));
                    return response()->json($dataList);
                    break;
                case 'getWeeklyDoctorsBookingCounts':
                    $doctors = Doctor::all();
                    for ($i = 20; $i >= 0; $i--) {
                        $startOfWeek = Carbon::now()->startOfWeek()->subWeeks($i);
                        $endOfWeek = Carbon::now()->endOfWeek()->subWeeks($i);
                        $array = array();
                        foreach ($doctors as $doctor) {
                            $bookingsBelongToDoctor = Booking::where('doctor_id', $doctor->id)
                            ->ofPeriod(date($startOfWeek), date($endOfWeek))->get();
                            $allBookings = Booking::ofPeriod(date($startOfWeek), date($endOfWeek))->get();
                            array_push($array, calculatePercentage(count($bookingsBelongToDoctor), count($allBookings)));
                        }
                        array_push($dataList, $array);                    
                    }
                    $previousDates = $dateAndDataMatcher->getPreviousWeeks(Carbon::now(), 20);
                    break;
                case 'getMonthlyDoctorsBookingCounts':
                    $doctors = Doctor::all();
                    for ($i = 10; $i >= 0; $i--) {
                        $startOfMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i);
                        $endOfMonth = Carbon::now()->endOfMonth()->subMonthsNoOverflow($i);
                        $array = array();
                        foreach ($doctors as $doctor) {
                            $bookingsBelongToDoctor = Booking::where('doctor_id', $doctor->id)
                            ->ofPeriod(date($startOfMonth), date($endOfMonth))->get();
                            $allBookings = Booking::ofPeriod(date($startOfMonth), date($endOfMonth))->get();
                            array_push($array, calculatePercentage(count($bookingsBelongToDoctor), count($allBookings)));
                        }
                        array_push($dataList, $array);                    
                    }
                    $previousDates = $dateAndDataMatcher->getPreviousMonths(Carbon::now(), 10);
                    break;
                case 'getBookingPatientCountsBelongToDoctorsLastTwentyWeeks':
                    $startOfPeriod = Carbon::now()->startOfWeek()->subWeeks(20);
                    $endOfPeriod = Carbon::now()->endOfWeek();
                    $doctors = Doctor::all();
                    foreach ($doctors as $doctor) {
                        $nameSurname = $doctor->name . ' ' . $doctor->surname;
                        $bookings = Booking::where('doctor_id', $doctor->id)->materialized()->get();
                        $patients = $doctor->patients()->get();
                        array_push($dataList, [$nameSurname, count($bookings), count($patients)]);           
                    }
                    // dd($dataList);
                    return response()->json($dataList);
                    break;
                case 'getBookingCalendarForDoctor':
                    $doctor = Doctor::where('user_id', $request->user()->id)->get();
                    for ($i = 0; $i <= 365; $i++) {
                        if ($i < Carbon::today()->diffInDays(Carbon::today()->startOfYear())) {
                            $date = Carbon::today()->startOfYear()->addDays($i);
                            $bookings = Booking::whereDate('booking_date', $date)
                            ->where([
                                ['doctor_id', $doctor[0]->id],
                                ['is_materialized', true]
                            ])->orderBy('booking_date', 'asc')->get();
                            array_push($dataList, [count($bookings), getHtmlTooltip($bookings, $date)]);
                        } else {
                            $date = Carbon::today()->startOfYear()->addDays($i);
                            $bookings = Booking::whereDate('booking_date', $date)
                            ->where([
                                ['doctor_id', $doctor[0]->id],
                                ['is_materialized', null]
                            ])->orderBy('booking_date', 'asc')->get();
                            array_push($dataList, [count($bookings), getHtmlTooltip($bookings, $date)]);
                        }
                    }
                    $previousDates = $dateAndDataMatcher->getNextDays(Carbon::today()->startOfYear(), 365);
                    break;
            }
    
            $dateAndDataMatcher->dateRelatedDatas = $dataList;
    
            $combinedDatesAndDatas = $dateAndDataMatcher->combineDatesAndDatas($previousDates);
    
            // dd($combinedDatesAndDatas);
    
            return response()->json($combinedDatesAndDatas);
        } else {
            echo $response->message();
        }        
    }
}
