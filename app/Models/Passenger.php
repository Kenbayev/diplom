<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_id',
        'name',
        'last_name',
        'citizens',
        'passport_id',
        'issue_date',
        'end_date',
        'issued_by',
        'birth_day_at',
        'sex',
        'baggage',
    ];
}
