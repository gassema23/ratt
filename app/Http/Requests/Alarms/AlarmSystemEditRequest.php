<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;

class AlarmSystemEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($alarm_id): array
    {
        return [
            'alarm.site_id' => [
                'required',
            ],
            'alarm.alarm_system_type_id' => [
                'required'
            ],
            'alarm.network_element' => [
                'nullable',
                'max:255'
            ],
            'alarm.location_number' => [
                'nullable',
                'max:255'
            ],
            'alarm.description.en' => [
                'nullable',
            ],
            'alarm.description.fr' => [
                'nullable',
            ],
            'alarm.ipv4' => [
                'nullable',
                'max:255'
            ]
        ];
    }
}
