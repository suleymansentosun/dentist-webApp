<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Gate::inspect('viewAny', Role::class);

        if (auth()->user()->can('viewAny', Role::class)) {
            $roles = Role::paginate(10);
            return view('roles.index')
                ->with('roles', $roles);
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
        $response = Gate::inspect('create', Role::class);

        if (auth()->user()->can('create', Role::class)) {
            return view('roles.create')
            ->with('role', (new Role()));
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
        $response = Gate::inspect('create', Role::class);

        if (auth()->user()->can('create', Role::class)) {
            $role = Role::create($request->input());
            return redirect()->action('RoleController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $doctorRole
     * @return \Illuminate\Http\Response
     */
    public function show($lang, Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $doctorRole
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Role $role)
    {
        $response = Gate::inspect('update', Role::class);

        if (auth()->user()->can('update', Role::class)) {
            return view('roles.edit')
            ->with('role', $role);
        } else {
            echo $response->message();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $doctorRole
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, Role $role)
    {
        $response = Gate::inspect('update', Role::class);

        if (auth()->user()->can('update', Role::class)) {
            $role->fill($request->input());
            $role->save();
    
            return redirect()->action('RoleController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $doctorRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Role $role)
    {
        $response = Gate::inspect('delete', Role::class);

        if (auth()->user()->can('delete', Role::class)) {
            $role->delete();
            return redirect()->action('RoleController@index', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }
    }
}
