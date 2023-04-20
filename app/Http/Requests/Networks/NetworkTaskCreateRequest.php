<?php

namespace App\Http\Requests\Networks;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NetworkTaskCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($team_id): array
    {
        return [
            'priority' => [
                'required'
            ],
            'due_date' => [
                'required',
                'date'
            ],
            'task_id' => [
                'required',
            ],
            'team_id' => [
                'required'
            ],
            'comment' => [
                'nullable'
            ]
        ];
    }
}
