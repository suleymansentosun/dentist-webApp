<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'patient_id',
        'bookingReason_id',
        'doctor_id',
        'booking_date',
        'notes',
        'user_id',
        'hasMaterializedBookingBefore'
    ];

    protected $dates = [
        'booking_date',
        'created_at',
        'updated_at',
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bookingReason()
    {
        return $this->belongsTo('App\BookingReason', 'bookingReason_id', 'id');
    }

    public function scopeMaterialized($query) 
    {
        return $query->where('is_materialized', true);
    }

    public function scopeNewPatient($query)
    {
        return $query->where([
            ['is_materialized', '=', 1],
            ['hasMaterializedBookingBefore', '=', 0],
        ]);
    }

    public function scopeOfPeriod($query, $dateFrom, $dateTo)
    {
        return $query->whereBetween('booking_date', [$dateFrom, $dateTo]);
    }

    public function scopeBookingReason($query, $bookingReasonId)
    {
        return $query->where('bookingReason_id', $bookingReasonId);
    }
}
