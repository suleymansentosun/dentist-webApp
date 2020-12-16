<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        $role = Auth::user()->roles()->orderBy('id', 'desc')->first()->name;

        // dd($role);

        switch ($role) {
            case 'Admin':
                    return '/dashboard';
                break;
            case 'Doctor':
                    return '/doctorDashboard';
                break;
            case 'Employee':
                    return '/employeeDashboard';
                break;
            case 'Patient':
                    return '/patientDashboard';
                break;
            default:
                    return '/login'; 
                break;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
