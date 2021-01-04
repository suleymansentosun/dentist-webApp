<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingReason extends Model
{
    public $table = "bookingReasons";

    protected $fillable = [
        'name',
        'nameEn'
    ];

    public function bookings() 
    {
        return $this->hasMany('App\Booking');
    }
}
