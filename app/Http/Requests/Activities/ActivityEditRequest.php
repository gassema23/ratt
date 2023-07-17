<?php

namespace App\Http\Requests\Activities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivityEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($activity_id): array
    {
        return [
            'activity.technology_id' => [
                'required',
            ],
            'activity.equipment_id' => [
                'required',
            ],
            'activity.category_id' => [
                'required',
            ],
            'activity.description.en' => [
                'required',
                'max:32768',
                Rule::unique('biri_activities', 'description')->ignore($activity_id),
            ],
            'activity.description.fr' => [
                'nullable',
                'max:32768',
                Rule::unique('biri_activities', 'description')->ignore($activity_id),
            ],
            'activity.avg_single' => [
                'nullable',
                'decimal:0,2'
            ],
            'activity.ps50_plan' => [
                'nullable',
                'decimal:0,2'
            ],
            'activity.ps50_act' => [
                'nullable',
                'decimal:0,2'
            ],
            'activity.avg_actual' => [
                'nullable',
                'decimal:0,2'
            ],
        ];
    }
}
