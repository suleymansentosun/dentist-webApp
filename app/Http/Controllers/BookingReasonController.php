<?php

namespace App\Http\Controllers;

use App\BookingReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use Illuminate\Support\Facades\Gate;

class BookingReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $response = Gate::inspect('viewAny', BookingReason::class);

        if (auth()->user()->can('viewAny', BookingReason::class)) {
            $bookingReasons = BookingReason::paginate(10);
            return view('bookingReasons.index')
                ->with('bookingReasons', $bookingReasons);
        } else {
            echo $response->message();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Gate::inspect('create', BookingReason::class);

        if (auth()->user()->can('create', BookingReason::class)) {
            return view('bookingReasons.create')
            ->with('bookingReason', (new BookingReason()));
        } else {
            echo $response->message();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Gate::inspect('create', BookingReason::class);

        if (auth()->user()->can('create', BookingReason::class)) {
            $bookingReason = BookingReason::create($request->input());
            return redirect()->action('BookingReasonController@index',  ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function show($lang, BookingReason $bookingReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, BookingReason $bookingReason)
    {
        $response = Gate::inspect('update', BookingReason::class);

        if (auth()->user()->can('update', BookingReason::class)) {
            return view('bookingReasons.edit')
            ->with('bookingReason', $bookingReason);
        } else {
            echo $response->message();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, BookingReason $bookingReason)
    {
        $response = Gate::inspect('update', BookingReason::class);

        if (auth()->user()->can('update', BookingReason::class)) {
            $bookingReason->fill($request->input());
            $bookingReason->save();
            return redirect()->action('BookingReasonController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingReason  $bookingReason
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, BookingReason $bookingReason)
    {
        $response = Gate::inspect('delete', BookingReason::class);

        if (auth()->user()->can('delete', BookingReason::class)) {
            $bookingReason->delete();
            return redirect()->action('BookingReasonController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }
}
