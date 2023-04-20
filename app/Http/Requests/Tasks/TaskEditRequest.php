<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($task_id): array
    {
        return [
            'task.name.en' => [
                'required',
                'max:125',
            ],
            'task.name.fr' => [
                'nullable',
                'max:125',
            ],
            'task.team_id' => [
                'required'
            ],
            'task.parent_id' => [
                'nullable'
            ]
        ];
    }
}
