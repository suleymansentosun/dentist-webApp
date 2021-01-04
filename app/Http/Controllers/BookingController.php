<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;
use App\Patient;
use App\Doctor;
use App\BookingReason;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->only('create');
        $this->middleware('checkBookingDateAndTime')->only(['edit', 'update']);
    }

    public function index()
    {
        $response = Gate::inspect('viewAny', Booking::class);

        if (auth()->user()->can('viewAny', Booking::class)) {
            $bookings = Booking::paginate(10);
            return view('bookings.index')
                ->with('bookings', $bookings);
        } else {
            echo $response->message();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang, $booking_date, $doctor_id, $bookingReason_id)
    {
        $currentUser =  Auth::user();
        $doctor = Doctor::all()->find($doctor_id);
        $doctors = Doctor::all();
        $bookingReasons = BookingReason::all();
        $bookingReason = BookingReason::all()->find($bookingReason_id);
        $booking = new Booking();

        return view('bookings.create')
            ->with('booking', $booking)
            ->with('user', $currentUser)
            ->with('booking_date', $booking_date)
            ->with('doctor', $doctor)
            ->with('doctors', $doctors)
            ->with('bookingReason', $bookingReason)
            ->with('bookingReasons', $bookingReasons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentBookingForRequestedTime = Booking::whereDate('booking_date', $request->input('booking_date'))
        ->where('doctor_id', $request->input('doctor_id'))->get();

        $requestedDate = date_create($request->input('booking_date'));
        $dateNow = new DateTime('now');

        $thePatient = DB::table('patients')
                            ->where('citizenship_number', '=', $request->input('citizenship_number'))
                            ->get();

        if (count($thePatient) == 0) {
            $patient = Patient::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'phone_number' => $request->input('phone_number'),
                'citizenship_number' => $request->input('citizenship_number'),
                'is_certain' => false,
            ]);

            $user = User::find($request->input('user_id'));
            $user->roles()->syncWithoutDetaching(2);
    
            $user->patients()->attach($patient->id);
        }

        if (count($thePatient) == 1) {
            $relatedPatient = Patient::find($thePatient[0]->id);
            $matchThese = ['patient_id' => $relatedPatient->id, 'is_materialized' => true];
            $materializedBookings = Booking::where($matchThese)->get();
        }

        $booking = Booking::create([
            'doctor_id' => $request->input('doctor_id'),
            'booking_date' => $request->input('booking_date'),
            'user_id' => $request->input('user_id'),
            'patient_id' => count($thePatient) == 0 ? $patient->id : $thePatient[0]->id,
            'bookingReason_id' => $request->input('bookingReason_id'),
            'notes' => $request->input('notes'),
            'hasMaterializedBookingBefore' => count($thePatient) == 1 && count($materializedBookings) > 0 ? true : false,
        ]);

        $booking->patient->doctors()->syncWithoutDetaching($booking->doctor_id);

        return redirect(App::getLocale() . '/responseToApply');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Booking $booking, Request $request)
    {
        $response = Gate::inspect('view', $booking);

        if (auth()->user()->can('view', $booking)) {
            return view('bookings.show', ['booking' => $booking]);
        } else {
            echo $response->message();
        }                 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Booking $booking, Request $request)
    {
        $response = Gate::inspect('update', $booking);

        if (auth()->user()->can('update', $booking)) {
            $currentDoctor = Doctor::all()->find($booking->doctor_id);
            $doctors = Doctor::all();
            $bookingReasons = BookingReason::all();
            $currentUser =  Auth::user();
            $currentBookingReason = BookingReason::all()->find($booking->bookingReason_id);
            $currentBookingDate = $booking->booking_date;
    
            return view('bookings.edit')
                ->with('doctor', $currentDoctor)
                ->with('user', $currentUser)
                ->with('bookingReason', $currentBookingReason)
                ->with('booking_date', $currentBookingDate)
                ->with('booking', $booking)
                ->with('doctors', $doctors)
                ->with('bookingReasons', $bookingReasons);
        } else {
            echo $response->message();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, Booking $booking)
    {
        $response = Gate::inspect('update', $booking);

        if (auth()->user()->can('update', $booking)) {
            $previousUser_id = $booking->user_id;
            $previousDoctor_id = $booking->doctor_id;
            // dd($user_id);
    
            $booking->update($request->input());
    
            $booking->patient->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'phone_number' => $request->input('phone_number'),
                'citizenship_number' => $request->input('citizenship_number')
            ]);
    
            // dd(count(Booking::all()->where('user_id', '=', $previousUser_id)));
    
            if (count(Booking::all()->where('user_id', '=', $previousUser_id)) == 0) {
                DB::table('role_user')->where([
                    ['user_id', '=', $previousUser_id],
                    ['role_id', '=', 3],
                ])->delete();
            }
    
            if (count(DB::table('bookings')->where([
                ['user_id', '=', $previousUser_id],
                ['patient_id', '=', $booking->patient_id],
            ])->get()) == 0) {
                DB::table('user_patient')->where([
                    ['user_id', '=', $previousUser_id],
                    ['patient_id', '=', $booking->patient_id],
                ])->delete();
            }
    
            if (count(DB::table('bookings')->where([
                ['doctor_id', '=', $previousDoctor_id],
                ['patient_id', '=', $booking->patient_id],
            ])->get()) == 0) {
                DB::table('doctor_patient')->where([
                    ['doctor_id', '=', $previousDoctor_id],
                    ['patient_id', '=', $booking->patient_id],
                ])->delete();
            }
    
            $user = User::find($request->input('user_id'));
            $user->roles()->syncWithoutDetaching(2);
    
            $user->patients()->syncWithoutDetaching($booking->patient_id);
    
            // Aslında doktor hasta ilişkisi aktif olup olmadığı da önemli olabilir. Bu şu an düşünülmedi.
            $booking->patient->doctors()->syncWithoutDetaching($booking->doctor_id);
    
            return redirect()->action('HomeController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking, Request $request)
    {
        $response = Gate::inspect('delete', $booking);

        if (auth()->user()->can('delete', $booking)) {
            $bookingPatient = $booking->patient;
            $booking->delete();
            $activeBookingOfPatient = Booking::where('is_materialized', '!=', false)->orWhereNull('is_materialized')
            ->where('patient_id', $booking->patient_id)->get();
            
            if ($activeBookingOfPatient->isEmpty()) {
                $bookingPatient->delete();
                $bookingPatient->users()->detach();
                $bookingPatient->doctors()->detach();
            }
            return redirect()->action('BookingController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }
}
