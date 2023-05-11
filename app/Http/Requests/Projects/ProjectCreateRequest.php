<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:125',
            ],
            'prime_id' => [
                'required'
            ],
            'planner_id' => [
                'required'
            ],
            'project_no' => [
                'required',
                function ($attribute, $value, $fail) {
                    $pattern = 'P-\d{7}\.\d{2}';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('The project number is invalid'));
                    }
                },
                'unique:projects,project_no'
            ],
            'started_at' => [
                'required',
                'date'
            ],
            'ended_at' => [
                'required',
                'date'
            ]
        ];
    }
}
