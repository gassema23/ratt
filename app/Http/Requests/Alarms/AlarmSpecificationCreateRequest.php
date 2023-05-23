<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AlarmSpecificationCreateRequest extends FormRequest
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
                UniqueTranslationRule::for('alarm_specifications')
            ],
            'description' => [
                'nullable'
            ]
        ];
    }
}
