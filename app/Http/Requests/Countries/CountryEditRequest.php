<?php

namespace App\Http\Requests\Countries;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($country_id): array
    {
        return [
            'country.name.en' => [
                'required',
                'max:125',
                Rule::unique('countries', 'name')->ignore($country_id)
            ],
            'country.name.fr' => [
                'nullable',
                'max:125',
                Rule::unique('countries', 'name')->ignore($country_id)
            ],
            'country.iso' => [
                'required',
                'max:3'
            ],
            'country.capital' => [
                'nullable',
                'max:125'
            ],
            'country.region' => [
                'nullable',
                'max:125'
            ],
            'country.sub_region' => [
                'nullable',
                'max:125'
            ],
            'country.latitude' => [
                'nullable',
                'decimal:8,10'
            ],
            'country.longitude' => [
                'nullable',
                'decimal:8,11'
            ]
        ];
    }
}
