<?php

namespace App\Http\Requests\Documentations;

use Illuminate\Foundation\Http\FormRequest;

class DocumentationEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'documentation.name.en' => [
                'required',
                'max:255'
            ],
            'documentation.name.fr' => [
                'required',
                'max:255'
            ],
            'documentation.description.en' => [
                'required'
            ],
            'documentation.description.fr' => [
                'required'
            ],
            'documentation.category_id' => [
                'required'
            ]
        ];
    }
}
