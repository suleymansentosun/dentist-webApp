<?php

namespace App\Policies;

use App\BookingReason;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookingReasonPolicy
{
    use HandlesAuthorization;

    public function before($user) 
    {
        return $user->hasAnyRole(['Admin', 'Doctor', 'Employee'])
                    ? Response::allow()
                    : Response::deny('Sorry! You are not authorized for this operation.');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\BookingReason  $bookingReason
     * @return mixed
     */
    public function view(User $user, BookingReason $bookingReason)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\BookingReason  $bookingReason
     * @return mixed
     */
    public function update(User $user, BookingReason $bookingReason)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\BookingReason  $bookingReason
     * @return mixed
     */
    public function delete(User $user, BookingReason $bookingReason)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\BookingReason  $bookingReason
     * @return mixed
     */
    public function restore(User $user, BookingReason $bookingReason)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\BookingReason  $bookingReason
     * @return mixed
     */
    public function forceDelete(User $user, BookingReason $bookingReason)
    {
        //
    }
}
