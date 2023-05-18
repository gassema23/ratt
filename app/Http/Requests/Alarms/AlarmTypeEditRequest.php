<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlarmTypeEditRequest extends FormRequest
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
                Rule::unique('alarm_types', 'label')->ignore($alarm_id)
            ],
            'alarm.label.fr' => [
                'nullable',
                'max:125',
                Rule::unique('alarm_types', 'label')->ignore($alarm_id)
            ],
            'alarm.alarm_category_id' => [
                'required'
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
