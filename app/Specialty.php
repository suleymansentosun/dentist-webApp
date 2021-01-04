<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name',
        'nameEn',
    ];

    public function doctors()
    {
        return $this->belongsToMany('App\Doctor')->withPivot('id')->withTimestamps();
    }
}
