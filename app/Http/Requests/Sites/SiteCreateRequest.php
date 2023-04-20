<?php

namespace App\Http\Requests\Sites;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class SiteCreateRequest extends FormRequest
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
                UniqueTranslationRule::for('sites')
            ],
            'clli' => [
                'required',
                'max:15',
                'unique:sites,clli'
            ],
            'city_id' => [
                'required'
            ],
            'type_id' => [
                'required'
            ],
            'address' => [
                'nullable',
                'max:255'
            ],
            'latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'longitude' => [
                'nullable',
                'between:-90,90'
            ],
            'phone_line' => [
                'nullable',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
            'emergency_line' => [
                'nullable',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
            'manager' => [
                'nullable',
                'max:255'
            ],
            'plant' => [
                'nullable',
                'numeric'
            ],
            'contact_and_site_access' => [
                'nullable',
            ],
            'other_site_information' => [
                'nullable',
            ]
        ];
    }
}
