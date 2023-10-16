<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonCreateRequest extends FormRequest
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
                'required',
                'string',
            ],
            'birthday' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                'in:M,F',
            ],
        ];
    }
}
