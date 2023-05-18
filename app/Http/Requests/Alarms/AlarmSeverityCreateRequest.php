<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class AlarmSeverityCreateRequest extends FormRequest
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
                'max:125',
            ],
            'label.*' => [
                UniqueTranslationRule::for('alarm_severities')
            ],
            'description' => [
                'nullable'
            ],
            'code' => [
                'required',
                'max:2',
                Rule::unique('alarm_severities', 'code')

            ]
        ];
    }
}
