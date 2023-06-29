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
    public function rules($network): array
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
            'network.network_no' => [
                'required',
                'min:6',
                'max:10',
                Rule::unique('networks', 'network_no')->ignore($network->id)
            ],
            'network.started_at' => [
                'required',
                'after_or_equal:' . $network->project->started_at,
                'before:' . $network->project->ended_at
            ],
            'network.ended_at' => [
                'required',
                'date',
                'after:tomorrow',
                'before:' . $network->project->ended_at
            ]
        ];
    }
}
