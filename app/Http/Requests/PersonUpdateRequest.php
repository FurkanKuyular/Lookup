<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'gender' => str($this->input('gender'))->upper()->value(),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
            ],
            'birthday' => [
                'sometimes',
                'date',
            ],
            'gender' => [
                'sometimes',
                'in:M,F',
            ],
        ];
    }
}
