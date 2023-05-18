<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;

class AlarmListCreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'alarm_severity_id'=>[
                'required'
            ],
            'alarm_type_id'=>[
                'required'
            ],
            'model'=>[
                'required',
                'max:255'
            ],
            'item_number'=>[
                'required',
                'max:255'
            ],
            'ctl'=>[
                'nullable',
                'max:255'
            ],
            'verb1'=>[
                'nullable',
                'max:255'
            ],
            'verb2'=>[
                'nullable',
                'max:255'
            ],
            'io_terminal'=>[
                'nullable',
                'max:255'
            ],
            'document_code'=>[
                'nullable',
                'max:255'
            ],
            'description'=>[
                'nullable'
            ],
        ];
    }
}
