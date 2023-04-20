<?php

namespace App\Http\Requests\States;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($state_id): array
    {
        return [
            'state.name.en' => [
                'required',
                'max:125',
                Rule::unique('states', 'name')->ignore($state_id)
            ],
            'state.name.fr' => [
                'nullable',
                'max:125',
                Rule::unique('states', 'name')->ignore($state_id)
            ],
            'state.country_id' => [
                'required'
            ],
            'state.type_id' => [
                'required',
            ],
            'state.abbr' => [
                'required',
                'max:5'
            ],
            'state.latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'state.longitude' => [
                'nullable',
                'between:-90,90'
            ],
        ];
    }
}
