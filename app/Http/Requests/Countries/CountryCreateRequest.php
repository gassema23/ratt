<?php

namespace App\Http\Requests\Countries;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CountryCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:125',
            ],
            'name.*' => [
                UniqueTranslationRule::for('countries')
            ],
            'iso' => [
                'required',
                'max:3',
            ],
            'capital' => [
                'nullable',
                'max:125'
            ],
            'region' => [
                'nullable',
                'max:125'
            ],
            'sub_region' => [
                'nullable',
                'max:125'
            ],
            'latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'longitude' => [
                'nullable',
                'between:-90,90'
            ]
        ];
    }
}
