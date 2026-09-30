<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'email'             => 'required|email',
            'phone'             => [
                'required',
                'string',
                'min:7',
                'max:16',
                'regex:/^\+?[0-9]+$/',
            ],
            'date_of_birth'     => 'required|date|before:today',
            'marketing_consent' => 'sometimes|boolean',
        ];
    }
}
