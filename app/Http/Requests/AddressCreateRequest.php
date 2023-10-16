<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => [
                'required',
                'string',
            ],
            'post_code' => [
                'required',
                'string',
            ],
            'city_name' => [
                'required',
                'string',
            ],
            'country_name' => [
                'required',
                'string',
            ],
        ];
    }
}
