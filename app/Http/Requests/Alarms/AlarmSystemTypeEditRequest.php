<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlarmSystemTypeEditRequest extends FormRequest
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
                'max:125',
                Rule::unique('alarm_system_types', 'label')->ignore($alarm_id)
            ],
            'alarm.label.fr' => [
                'required',
                'max:125',
                Rule::unique('alarm_system_types', 'label')->ignore($alarm_id)
            ],
            'alarm.description.en' => [
                'nullable'
            ],
            'alarm.description.fr' => [
                'nullable'
            ]
        ];
    }
}
