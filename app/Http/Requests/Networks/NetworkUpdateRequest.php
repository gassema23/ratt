<?php

namespace App\Http\Requests\Networks;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NetworkUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($network_id, $project): array
    {
        return [
            'site_id' => [
                'required'
            ],
            'network.name' => [
                'required',
                'max:125'
            ],
            'network.priority' => [
                'nullable'
            ],
            'network_element' => [
                'required',
                'max:15',
                Rule::unique('networks', 'network_element')->ignore($network_id)
            ],
            'network.network_no' => [
                'required',
                'min:6',
                'max:10',
                Rule::unique('networks', 'network_no')->ignore($network_id)
            ],
            'network.started_at' => [
                'required',
                'after_or_equal:' . $project->started_at,
                'before:' . $project->ended_at
            ],
            'network.ended_at' => [
                'required',
                'date',
                'after:tomorrow',
                'before:' . $project->ended_at
            ]
        ];
    }
}
