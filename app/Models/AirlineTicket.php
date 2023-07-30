<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'flight_code',
        'airlines',
        'aircraft',
        'departure_date_at',
        'arrival_date_at',
        'flight_from_city_iso',
        'flying_time',
        'flight_to_city_iso',
        'number_seats',
        'ticket_token',
        'ticket_qr_token',
        'ticket_url',
        'ticket_qr_url',
        'passenger_id',
        'ticket_status',
        'payment_id',
        'baggage',
        'price',
        'default_price',
        'company_img'
    ];
}
