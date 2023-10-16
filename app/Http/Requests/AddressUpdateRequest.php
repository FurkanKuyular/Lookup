<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => [
                'sometimes',
                'string',
            ],
            'post_code' => [
                'sometimes',
                'string',
            ],
            'city_name' => [
                'sometimes',
                'string',
            ],
            'country_name' => [
                'sometimes',
                'string',
            ],
        ];
    }
}
