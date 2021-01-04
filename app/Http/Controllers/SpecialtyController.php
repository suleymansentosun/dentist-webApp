<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use Illuminate\Support\Facades\Gate;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Gate::inspect('viewAny', Specialty::class);

        if (auth()->user()->can('viewAny', Specialty::class)) {
            $specialties = specialty::paginate(10);

            return view('specialties.index')
                ->with('specialties', $specialties);
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
        $response = Gate::inspect('create', Specialty::class);

        if (auth()->user()->can('create', Specialty::class)) {
            return view('specialties.create')
            ->with('specialty', (new Specialty()));
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
        $response = Gate::inspect('create', Specialty::class);

        if (auth()->user()->can('create', Specialty::class)) {
            $specialty = specialty::create($request->all());

            return redirect()->action('SpecialtyController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function show($lang, doctorSpecialty $doctorSpecialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, specialty $specialty)
    {
        $response = Gate::inspect('update', Specialty::class);

        if (auth()->user()->can('update', Specialty::class)) {
            return view('specialties.edit')
            ->with('specialty', $specialty);
        } else {
            echo $response->message();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, specialty $specialty)
    {
        $response = Gate::inspect('update', Specialty::class);

        if (auth()->user()->can('update', Specialty::class)) {
            $specialty->update($request->input());

            return redirect()->action('SpecialtyController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, specialty $specialty)
    {
        $response = Gate::inspect('delete', Specialty::class);

        if (auth()->user()->can('delete', Specialty::class)) {
            $specialty->delete();
            return redirect()->action('SpecialtyController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }
}
