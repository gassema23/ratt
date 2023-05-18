<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlarmListEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($alarm_id): array
    {
        return [
            'alarm.alarm_severity_id'=>[
                'required'
            ],
            'alarm.alarm_type_id'=>[
                'required'
            ],
            'alarm.model'=>[
                'required',
                'max:255',
                Rule::unique('alarm_lists', 'model')->ignore($alarm_id)
            ],
            'alarm.item_number'=>[
                'required',
                'max:255'
            ],
            'alarm.ctl'=>[
                'nullable',
                'max:255'
            ],
            'alarm.verb1'=>[
                'nullable',
                'max:255'
            ],
            'alarm.verb2'=>[
                'nullable',
                'max:255'
            ],
            'alarm.io_terminal'=>[
                'nullable',
                'max:255'
            ],
            'alarm.document_code'=>[
                'nullable',
                'max:255'
            ],
            'alarm.description'=>[
                'nullable'
            ],
        ];
    }
}
