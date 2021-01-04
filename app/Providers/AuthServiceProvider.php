<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Doctor;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\BookingReason' => 'App\Policies\BookingReasonPolicy',
        'App\Doctor' => 'App\Policies\DoctorPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Specialty' => 'App\Policies\SpecialtyPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Booking' => 'App\Policies\BookingPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-user', function($user) {
            return $user->id === Auth::id()
                        ? Response::allow()
                        : Response::deny('Her bir kullanıcı sadece kendi hesabını güncelleyebilir!');
        });

        Gate::define('view-admin-dashboard', function($user) {
            return $user->hasRole('Admin')
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('view-doctor-dashboard', function($user) {
            return $user->hasRole('Doctor')
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('view-employee-dashboard', function($user) {
            return $user->hasRole('Employee')
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('view-patient-dashboard', function($user) {
            return $user->hasRole('Patient')
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('view-bookings-belongs-to-one-doctor', function($user, $id) {
            $doctor = Doctor::find($id);

            return $user->hasRole('Doctor') && $user->id === $doctor->user_id
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('view-historical-datas', function($user) {            
            return $user->hasAnyRole(['Admin', 'Doctor'])
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('view-notificated-bookings', function($user) {            
            return $user->hasRole('Employee')
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });

        Gate::define('finalize-notificated-bookings', function($user) {            
            return $user->hasRole('Employee')
                        ? Response::allow()
                        : Response::deny('Sorry! You are not authorized for this operation.');
        });
    }
}
