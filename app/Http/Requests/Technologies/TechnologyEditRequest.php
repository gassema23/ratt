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
            'technology.label.en' => [
                'required',
                'string',
                'max:125',
                Rule::unique('biri_technologies', 'label')->ignore($technology_id),
            ],
            'technology.label.fr' => [
                'nullable',
                'string',
                'max:125',
                Rule::unique('biri_technologies', 'label')->ignore($technology_id),
            ],
            'technology.description.en' => [
                'nullable',
                'max:32768',
            ],
            'technology.description.fr' => [
                'nullable',
                'max:32768',
            ],
        ];
    }
}
