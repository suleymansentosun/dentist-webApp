<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialties = specialty::paginate(10);

        return view('specialties.index')
            ->with('specialties', $specialties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialties.create')
            ->with('specialty', (new Specialty()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specialty = specialty::create($request->all());

        return redirect()->action('SpecialtyController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function show(doctorSpecialty $doctorSpecialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function edit(specialty $specialty)
    {
        return view('specialties.edit')
        ->with('specialty', $specialty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, specialty $specialty)
    {
        $specialty->update($request->input());

        return redirect()->action('SpecialtyController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\doctorSpecialty  $doctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(specialty $specialty)
    {
        $specialty->delete();
        return redirect()->action('SpecialtyController@index');
    }
}
