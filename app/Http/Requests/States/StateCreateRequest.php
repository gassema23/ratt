<?php

namespace App\Http\Requests\States;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class StateCreateRequest extends FormRequest
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
                UniqueTranslationRule::for('states')
            ],
            'country_id' => [
                'required'
            ],
            'type_id' => [
                'required',
            ],
            'latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'longitude' => [
                'nullable',
                'between:-90,90'
            ],
            'abbr' => [
                'required',
                'max:5'
            ],
        ];
    }
}
