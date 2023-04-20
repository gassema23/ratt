<?php

namespace App\Http\Requests\Cities;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CityCreateRequest extends FormRequest
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
                UniqueTranslationRule::for('cities')
            ],
            'clli' => [
                'required',
                'max:15',
                'unique:cities,clli'
            ],
            'latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'longitude' => [
                'nullable',
                'between:-90,90'
            ],
            'region_id' => [
                'required'
            ]
        ];
    }
}
