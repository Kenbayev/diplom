<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'passenger_id',
        'credit_card_numer',
        'name',
        'last_name',
        'date_end_at',
        'passport_id',
        'csv_number',
        'card_status',
    ];
}
