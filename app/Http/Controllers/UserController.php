<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use App;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Gate::inspect('viewAny', User::class);

        if (auth()->user()->can('viewAny', User::class)) {
            $users = User::paginate(10);
            return view('users.index')
                ->with('users', $users);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, User $user)
    {
        $response = Gate::inspect('view', $user);

        if (auth()->user()->can('view', $user)) {
            return view('users.show', ['user' => $user]);
        } else {
            echo $response->message();
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $user = User::find($id);

        $response = Gate::inspect('update', $user);

        if (auth()->user()->can('update', $user)) {
            return view('users.edit')
            ->with('user', $user);
        } else {
            echo $response->message();
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang, Request $request, $id)
    {
        $user = User::find($id);

        $response = Gate::inspect('update', $user);

        if (auth()->user()->can('update', $user)) {
            $user->update($request->input());
            return redirect()->route('responseUpdate', ['locale' => App::getLocale()]);
        } else {
            echo $response->message();
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, User $user)
    {
        $response = Gate::inspect('delete', $user);

        if (auth()->user()->can('delete', $user)) {
            $user->roles()->detach();
            $user->doctor()->delete();
            $user->delete();
            
            if ($loggedInUser->hasRole('Admin')) {
                return redirect()->action('UserController@index', ['locale' => App::getLocale()]);
            } else {
                return redirect('/home');
            }    
        } else {
            echo $response->message();
        }               
    }
}
