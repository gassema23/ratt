<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AlarmSeverityEditRequest extends FormRequest
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
                Rule::unique('alarm_severities', 'label')->ignore($alarm_id)
            ],
            'alarm.label.fr' => [
                'nullable',
                'max:125',
                Rule::unique('alarm_severities', 'label')->ignore($alarm_id)
            ],
            'alarm.description.en'=>[
                'nullable'
            ],
            'alarm.description.fr'=>[
                'nullable'
            ],
            'alarm.code'=>[
                'required',
                'max:2',
                Rule::unique('alarm_severities', 'code')->ignore($alarm_id)

            ]
        ];
    }
}
