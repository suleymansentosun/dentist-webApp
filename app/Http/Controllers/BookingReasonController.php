<?php

namespace App\Http\Controllers;

use App\BookingReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingReasons = BookingReason::paginate(10);
        return view('bookingReasons.index')
            ->with('bookingReasons', $bookingReasons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookingReasons.create')
            ->with('bookingReason', (new BookingReason()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::table('booking_reasons')->insert([
        //     'name' => $request->input('bookingReason')
        // ]);
        $bookingReason = BookingReason::create($request->input());
        return redirect()->action('BookingReasonController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function show(BookingReason $bookingReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingReason $bookingReason)
    {
        return view('bookingReasons.edit')
            ->with('bookingReason', $bookingReason);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingReason $bookingReason)
    {
        $bookingReason->fill($request->input());
        $bookingReason->save();
        return redirect()->action('BookingReasonController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingReason $bookingReason)
    {
        $bookingReason->delete();
        return redirect()->action('BookingReasonController@index');
    }
}
