<?php

namespace App\Http\Requests\Activities;

use Illuminate\Foundation\Http\FormRequest;

class ActivityEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'biri_activity.technology_name' => [
                'required'
            ],
            'biri_activity.equipment_name' => [
                'required'
            ],
            'biri_activity.activity_name' => [
                'required'
            ],
            'biri_activity.activity_description' => [
                'required'
            ],
            'biri_activity.average' => [
                'nullable'
            ],
            'biri_activity.average_actual' => [
                'nullable'
            ],
            'biri_activity.ps50_plan' => [
                'nullable'
            ],
            'biri_activity.ps50_activity' => [
                'nullable'
            ],
        ];
    }
}
