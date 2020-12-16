<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'phone_number',
        'user_id',
        'citizenship_number',
    ];

    /**
     * Get the bookings for the patient
     */
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function users() 
    {
        return $this->belongsToMany('App\User', 'user_patient')->withTimestamps();
    }

    public function doctorReviews()
    {
        return $this->hasMany('App\DoctorReview');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Doctor')->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }
}
