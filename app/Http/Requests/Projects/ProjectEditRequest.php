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
            'project.name' => [
                'required',
                'max:125',
            ],
            'project.prime_id' => [
                'required'
            ],
            'project.planner_id' => [
                'required'
            ],
            'project.project_no' => [
                'required',
                "unique:projects,project_no,{$project_id},id,deleted_at,NULL",
                function ($attribute, $value, $fail) {
                    $pattern = '\d{7}\.\d{2}';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('The project number is invalid'));
                    }
                },
            ],
            'project.started_at' => [
                'required',
                'date',
                'after_or_equal:project.started_at'
            ],
            'project.ended_at' => [
                'required',
                'date'
            ]
        ];
    }
}
