<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlarmGeneratorTypeEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($alarm_id): array
    {
        return [
            'alarm.label.en' => [
                'required',
                'max:255',
                Rule::unique('alarm_generator_types', 'label')->ignore($alarm_id)
            ],
            'alarm.label.fr' => [
                'required',
                'max:255',
                Rule::unique('alarm_generator_types', 'label')->ignore($alarm_id)
            ],
            'alarm.prerequiste.en' => [
                'nullable'
            ],
            'alarm.prerequiste.fr' => [
                'nullable'
            ],
            'alarm.deployment_procedure.en' => [
                'nullable'
            ],
            'alarm.deployment_procedure.fr' => [
                'nullable'
            ],
            'alarm.emergency_contact.en' => [
                'nullable'
            ],
            'alarm.emergency_contact.fr' => [
                'nullable',
                'max:255',
            ],
            'alarm.generator_available.en' => [
                'nullable',
                'max:255',
            ],
            'alarm.generator_available.fr' => [
                'nullable'
            ]
        ];
    }
}
