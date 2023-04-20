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
            'description' => [
                'nullable'
            ],
            'prime_id' => [
                'required'
            ],
            'planner_id' => [
                'required'
            ],
            'project_no' => [
                'required',
                'min:7',
                'max:10',
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
