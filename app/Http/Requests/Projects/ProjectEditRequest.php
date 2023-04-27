<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($project_id): array
    {
        return [
            'project.name.en' => [
                'required',
                'max:125',
            ],
            'project.description.en' => [
                'nullable'
            ],
            'project.name.fr' => [
                'required',
                'max:125',
            ],
            'project.description.fr ' => [
                'nullable'
            ],
            'project.prime_id' => [
                'required'
            ],
            'project.planner_id' => [
                'required'
            ],
            'project.project_no' => [
                'required',
                function ($attribute, $value, $fail) {
                    $pattern = 'P-\d{7}\.\d{2}';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('The project number is invalid'));
                    }
                },
                Rule::unique('projects', 'project_no')->ignore($project_id)
            ],
            'project.started_at' => [
                'required',
                'date'
            ],
            'project.ended_at' => [
                'required',
                'date'
            ]
        ];
    }
}
