<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorReview extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'headline',
        'rating',
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
