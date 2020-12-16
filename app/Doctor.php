<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'profile_picture',
        'surname',
        'graduation_date',
        'starting_date_employement',
        'salary',
    ];

    /**
     * Get the bookings for the doctor.
     */
    
     public function bookings()
     {
         return $this->hasMany('App\Booking');
     }

     public function user() 
     {
         return $this->hasOne('App\User');
     }

     public function doctorReviews()
     {
         return $this->hasMany('App\DoctorReview');
     }

     public function specialties()
     {
         return $this->belongsToMany('App\Specialty')->withPivot('id')->withTimestamps();
     }

     public function patients()
     {
         return $this->belongsToMany('App\Patient')->withTimestamps();
     }

     public function getFullNameAttribute()
     {
         return "{$this->name} {$this->surname}";
     }
}
