<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AlarmGeneratorTypeCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'label' => [
                'required',
                'max:255',
            ],
            'label.*' => [
                UniqueTranslationRule::for('alarm_generator_types')
            ],
            'prerequiste' => [
                'nullable'
            ],
            'deployment_procedure' => [
                'nullable'
            ],
            'emergency_contact' => [
                'nullable',
                'max:255',
            ],
            'generator_available' => [
                'nullable',
                'max:255',
            ]
        ];
    }
}
