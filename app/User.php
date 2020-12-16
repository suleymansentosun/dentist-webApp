<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'instrumentalInFind',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function patients()
    {
        return $this->belongsToMany('App\Patient', 'user_patient')->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {            
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function scopeCreatedDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeCreatedDatePeriod($query, $dateFrom, $dateTo)
    {
        return $query->whereBetween('created_at', [$dateFrom, $dateTo]);
    }

    public function scopeInstrumentalFactorInFinding($query, $factor)
    {
        return $query->where('instrumentalInFind', '=', $factor);
    }
}
