<?php

namespace App\Http\Requests\Technologies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnologyEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($technology_id): array
    {
        return [
            'technology.name.en' => [
                'required',
                'string',
                'max:125',
                Rule::unique('technologies', 'name')->ignore($technology_id)
            ],
            'technology.name.fr' => [
                'nullable',
                'string',
                'max:125',
                Rule::unique('technologies', 'name')->ignore($technology_id)
            ]
        ];
    }
}
