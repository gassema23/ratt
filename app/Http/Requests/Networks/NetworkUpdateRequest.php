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
    public function rules($network_id): array
    {
        return [
            'site_id' => [
                'required'
            ],
            'network.name.en' => [
                'required',
                'max:125'
            ],
            'network.description.en' => [
                'nullable'
            ],
            'network.name.fr' => [
                'nullable',
                'max:125'
            ],
            'network.description.fr' => [
                'nullable'
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
                'date'
            ],
            'network.ended_at' => [
                'required',
                'date'
            ]
        ];
    }
}
