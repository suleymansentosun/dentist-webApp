<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use Illuminate\Support\Facades\Gate;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $response = Gate::inspect('viewAny', Doctor::class);

        if (auth()->user()->can('viewAny', Doctor::class)) {
            $doctors = doctor::paginate(10);
            return view('doctors.index')
                ->with('doctors', $doctors);
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
        $response = Gate::inspect('create', Doctor::class);

        if (auth()->user()->can('create', Doctor::class)) {
            $users = user::all()->pluck('name', 'id')->prepend('Seçili Değil');
            $specialties = specialty::all()->pluck('name', 'id')->prepend('Bir veya birden fazla seçim yapınız');
    
            return view('doctors.create')
                ->with('doctor', (new Doctor()))          
                ->with('users', $users)
                ->with('specialties', $specialties);
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
        $response = Gate::inspect('create', Doctor::class);

        if (auth()->user()->can('create', Doctor::class)) {
            $doctor = new Doctor();

            $doctor->name = $request->input('name');
            $doctor->surname = $request->input('surname');
            $doctor->graduation_date = $request->input('graduation_date');
            $doctor->starting_date_employement = $request->input('starting_date_employement');
            $doctor->salary = $request->input('salary');
    
            if ($request->hasFile('profile_picture')) {
                if ($request->file('profile_picture')->isValid()) {
                    $validatedData = $request->validate([
                        'profile_picture' => ['dimensions:min_width=100,min_height=200','mimes:jpeg, bmp, png', 'max:512']
                    ]);
                    $extension = $request->file('profile_picture')->extension();
                    $fileName = time() . '.' . $extension;
                    $request->file('profile_picture')->storeAs(
                        'public', $fileName
                    );
                }
            } else {
                abort(500, 'Resim yüklenemedi.');
            }
    
            $doctor->profile_picture = $fileName;
            $doctor->save();
    
    
            foreach ($request->input('specialties') as $specialty) {
                $doctor->specialties()->attach($specialty);
            }
    
            $user = User::find($request->input('user_id'));
            $user->roles()->attach(4);
    
            return redirect()->action('DoctorController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Doctor $doctor)
    {
        $response = Gate::inspect('view', Doctor::class);

        if (auth()->user()->can('view', Doctor::class)) {
            return view('doctors.show', ['doctor' => $doctor]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Doctor $doctor)
    {        
        $response = Gate::inspect('update', Doctor::class);

        if (auth()->user()->can('update', Doctor::class)) {
            $users = user::all()->pluck('name', 'id')->prepend('Seçili Değil');
            $specialties = specialty::all()->pluck('name', 'id')->prepend('Bir veya birden fazla seçim yapınız');
            $doctor_specialtyIds = array();
    
            foreach($doctor->specialties as $specialty) {
                array_push($doctor_specialtyIds, $specialty->pivot->specialty_id); 
            }
    
            return view('doctors.edit')            
                ->with('users', $users)
                ->with('specialties', $specialties)
                ->with('doctor', $doctor)
                ->with('doctor_specialtyIds', $doctor_specialtyIds);
        } else {
            echo $response->message();
        }
    }

    public function updatePivotTable($lang, $pivotTableName, $filterColumnName, $filterValue, $request, $fieldName, $dataToBeUpdated) {
        $pvtTbleRelatedRowIds = array();
        $pvtTbleArrOfRelatedRowObjs = DB::table($pivotTableName)->where($filterColumnName, '=', $filterValue)->get();
        foreach($pvtTbleArrOfRelatedRowObjs as $index => $rowObj) {
            array_push($pvtTbleRelatedRowIds, $rowObj->id);
        }

        foreach($request->input($fieldName) as $index => $freshData) {
            DB::table($pivotTableName)->updateOrInsert(
                [$filterColumnName => $filterValue, 
                'id' => array_key_exists($index, $pvtTbleRelatedRowIds) ? $pvtTbleRelatedRowIds[$index] : 
                DB::table($pivotTableName)->orderBy('id', 'desc')->get()[0]->id + 1],
                [$dataToBeUpdated => $freshData]
            );
        }

        $countPreviousSelect = count($pvtTbleRelatedRowIds);
        $countCurrentSelect = count($request->input($fieldName));
        $surplusSpecialtyIds = array_slice($pvtTbleRelatedRowIds, $countCurrentSelect);

        if($countCurrentSelect < $countPreviousSelect) {
            foreach($surplusSpecialtyIds as $index => $rowId) {
                DB::table($pivotTableName)->where('id', '=', $rowId)->delete();
            }            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, Doctor $doctor)
    {
        $response = Gate::inspect('update', Doctor::class);

        if (auth()->user()->can('update', Doctor::class)) {
            $doctor->name = $request->input('name');
            $doctor->surname = $request->input('surname');
            $doctor->graduation_date = $request->input('graduation_date');
            $doctor->starting_date_employement = $request->input('starting_date_employement');
            $doctor->salary = $request->input('salary');
    
            if ($request->hasFile('profile_picture')) {
                if ($request->file('profile_picture')->isValid()) {
                    $validatedData = $request->validate([
                        'profile_picture' => 'mimes:jpeg,jpg,png,gif|max:512'
                    ]);
                    $extension = $request->file('profile_picture')->extension();
                    $fileName = time() . '.' . $extension;
                    $request->file('profile_picture')->storeAs(
                        'public', $fileName
                    );
                }
            } else {
                abort(500, 'Resim yüklenemedi.');
            }
    
            $doctor->profile_picture = $fileName;
            $doctor->save();
    
            $newDoctorSpecialtyIds = array();
    
            foreach($request->input('specialties') as $specialty_id) {
                array_push($newDoctorSpecialtyIds, $specialty_id);
            }
    
            $doctor->specialties()->sync($newDoctorSpecialtyIds);
    
            return redirect()->action('DoctorController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Doctor $doctor)
    {
        $response = Gate::inspect('delete', Doctor::class);

        if (auth()->user()->can('delete', Doctor::class)) {
            $doctor->specialties()->detach();
            $doctor->delete();
            
            return redirect()->action('DoctorController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }
}
