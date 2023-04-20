<?php

namespace App\Http\Requests\Cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($city_id): array
    {
        return [
            'city.name.en' => [
                'required',
                'max:125',
                Rule::unique('cities', 'name')->ignore($city_id)
            ],
            'city.name.fr' => [
                'required',
                'max:125',
                Rule::unique('cities', 'name')->ignore($city_id)
            ],
            'city.clli' => [
                'required',
                'max:15',
                Rule::unique('cities', 'clli')->ignore($city_id)
            ],
            'region_id' => [
                'required'
            ],
            'city.latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'city.longitude' => [
                'nullable',
                'between:-90,90'
            ],
        ];
    }
}
