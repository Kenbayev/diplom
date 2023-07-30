<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    use HasFactory;

    protected $fillable = [
        'aircraft',
        'airlines',
        'flight_code',
        'flight_from_country',
        'flight_from_city',
        'flight_from_city_iso',
        'flight_to_country',
        'flight_to_city',
        'flight_to_city_iso',
        'flying_time',
        'departure_date_at',
        'arrival_date_at',
        'f_class',
        'b_class',
        'e_class'
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function airlines()
    {
        return $this->belongsTo('App\Models\Airlines', 'id');
    }
}
