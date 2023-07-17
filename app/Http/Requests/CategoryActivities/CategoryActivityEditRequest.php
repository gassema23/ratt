<?php

namespace App\Http\Requests\CategoryActivities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryActivityEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($activity_id): array
    {
        return [
            'categoryactivity.label.en' => [
                'required',
                'string',
                'max:125',
                Rule::unique('biri_category_activities', 'label')->ignore($activity_id),
            ],
            'categoryactivity.label.fr' => [
                'nullable',
                'string',
                'max:125',
                Rule::unique('biri_category_activities', 'label')->ignore($activity_id),
            ],
            'categoryactivity.description.en' => [
                'nullable',
                'max:32768',
            ],
            'categoryactivity.description.fr' => [
                'nullable',
                'max:32768',
            ],
        ];
    }
}
