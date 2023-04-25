<?php

namespace App\Http\Requests\Documentations;

use Illuminate\Foundation\Http\FormRequest;

class DocumentationCreateRequest extends FormRequest
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
                'max:255'
            ],
            'category_id' => [
                'required'
            ]
        ];
    }
}
