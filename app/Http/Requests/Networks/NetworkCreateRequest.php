<?php

namespace App\Http\Requests\Networks;

use Illuminate\Foundation\Http\FormRequest;

class NetworkCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($project): array
    {
        return [
            'site_id' => [
                'required'
            ],
            'name' => [
                'required',
                'max:125'
            ],
            'description' => [
                'nullable'
            ],
            'priority' => [
                'nullable'
            ],
            'network_element' => [
                'required',
                'max:15',
                'unique:networks,network_element'
            ],
            'network_no' => [
                'required',
                'min:6',
                'max:10',
                'unique:networks,network_no'
            ],
            'started_at' => [
                'required',
                'after:' . $project->started_at,
                'before:' . $project->ended_at
            ],
            'ended_at' => [
                'required',
                'after:tomorrow',
                'before:' . $project->ended_at
            ]
        ];
    }
}
