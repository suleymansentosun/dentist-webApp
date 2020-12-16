<?php

namespace App\Http\Controllers;

use App\DoctorReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DoctorReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctorReviews = DoctorReview::paginate(1);
        return view('doctorReviews.index')
            ->with('doctorReviews', $doctorReviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();
        $doctors = DB::table('doctors')->get()->pluck('name', 'id')->prepend('Seçili Değil');
        $relatedUser = DB::table('users')->where('id', $id)->get()->pluck('name', 'id')->prepend('Seçili Değil');
        $patient = DB::table('patients')->where('user_id', '=', $id)->get()->pluck('name', 'id')->prepend('Seçili Değil');

        return view('doctorReviews.create')
            ->with('doctors', $doctors)
            ->with('doctorReview', (new DoctorReview()))
            ->with('patient', $patient);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $id = DB::table('doctors')->insert([
        //     'patient_id' => $request->input('patient_id'),
        //     'doctor_id' => $request->input('doctor_id'),
        //     'headline' => $request->input('review_headline'),
        //     'rating' => $request->input('doctor_rating'),
        // ]);

        $doctorReview = DoctorReview::create($request->input());
        // return redirect()->action('DoctorReviewController@index');
        // Kullanıcının dashboard'ına yönlendirsin
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DoctorReview  $doctorReview
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorReview $doctorReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DoctorReview  $doctorReview
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorReview $doctorReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DoctorReview  $doctorReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorReview $doctorReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DoctorReview  $doctorReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorReview $doctorReview)
    {
        //
    }
}
