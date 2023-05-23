<?php

namespace App\Http\Requests\Alarms;

use Illuminate\Foundation\Http\FormRequest;

class AlarmSystemCreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'site_id' => [
                'required',
            ],
            'alarm_system_type_id'=>[
                'required'
            ],
            'network_element'=>[
                'nullable',
                'max:255'
            ],
            'location_number'=>[
                'nullable',
                'max:255'
            ],
            'description'=>[
                'nullable',
            ],
            'ipv4'=>[
                'nullable',
                'max:255'
            ]
        ];
    }
}
