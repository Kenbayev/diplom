<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreAirlinesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required', 'string',
            ],
            'description' => [
                'required', 'string',
            ],
            'country_name' => [
                'required', 'string',
            ],
            'country_iso' => [
                'required', 'string',
            ]
        ]; 
    }

    public function authorize()
    {
        return true;
    }
}
