<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

})->middleware('detectClientLanguage')->name('welcomePage');

Route::get('/home', function () {

})->middleware('detectClientLanguage');

Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    
    Auth::routes();
    
    Route::get('dashboard', 'Admin\ShowDashboard@showDashboard')->name('dashboard');
    
    Route::get('doctorDashboard', 'Doctor\DoctorDashboardController@showDashboard');
    
    Route::get('getBookingsOfDoctor/{id}/{booking_date?}', 'Doctor\DoctorDashboardController@showBookingsOfDoctor');
    
    Route::get('employeeDashboard', 'Employee\EmployeeDashboardController@showDashboard');
    
    Route::get('patientDashboard', 'Patient\PatientDashboardController@showDashboard');
    
    Route::get('getTodaysBookings', 'Employee\EmployeeDashboardController@getTodaysBookings');
    
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/responseToApply', 'ResponseToApply')->name('response');
    
    Route::get('/responseToUpdateUserProfile', 'ResponseToUpdateUserProfile')->name('responseUpdate');
    
    Route::get('/test', function() { return "Goodbye"; });
    
    
    Route::resource('bookings', 'BookingController')->except(['create']);
    
    Route::get('bookingCreatePageWithPassedData/{booking_date?}/{doctor_id?}/{bookingReason_id?}', 'BookingController@create')->name('finalPartBooking');
    
    Route::resource('users', 'UserController');
    
    Route::resource('doctors', 'DoctorController');
    
    Route::resource('bookingReasons', 'BookingReasonController');
    
    Route::resource('roles', 'RoleController');
    
    Route::resource('specialties', 'SpecialtyController');
    
    Route::resource('patients', 'PatientController');
    
    Route::resource('doctorReviews', 'DoctorReviewController');
    
    
    Route::get('/getDailyBookingDatas', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getWeeklyBookingDatas', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getMonthlyBookingDatas', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getDailyPatientDatas', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getWeeklyPatientDatas', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getMonthlyPatientDatas', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getDailyInstrumentalFactorsInFindingDentist', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getWeeklyInstrumentalFactorsInFindingDentist', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getMonthlyInstrumentalFactorsInFindingDentist', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getInstrumentalFactorsInFindingDentistLastTwentyWeeks', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getInstrumentalFactorsInFindingDentistLastTenMonths', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getBookingReasonsCountsLastTwentyWeeks', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getBookingReasonsCountsLastTenMonths', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getWeeklyDoctorsBookingCounts', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getMonthlyDoctorsBookingCounts', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getBookingPatientCountsBelongToDoctorsLastTwentyWeeks', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    Route::get('/getBookingCalendarForDoctor', 'ReturnHistoricalDatas@returnHistoricalDatas');
    
    
    Route::get('/getBookings', 'FinalizeBookingController@notificateToFront');

    Route::put('/finalizeAndUpdateBooking', 'FinalizeBookingController@finalizeAndUpdateBooking');
    
    Route::get('/getAllBookingReasonsForFirstStageOfBooking', 'FirstStageOfBookingController@returnBookingReasons');
    
    Route::get('/getRelatedDoctorInfos/{bookingReasonId}/{doctorIdToBeViewedAtTheTop}', 'FirstStageOfBookingController@returnRelatedDoctorInfos');
    
    Route::get('/getAvailableBookingsForRelatedDoctors/{doctorIds}/{currentDatesOnBookingCalendar}', 
    'FirstStageOfBookingController@returnAvailableBookingsForRelatedDoctors');    
});









