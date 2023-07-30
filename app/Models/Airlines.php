<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airlines extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'country_name',
        'country_iso',
        'default_price',
        'company_img'
    ];

    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
