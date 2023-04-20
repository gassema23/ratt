<?php

namespace App\Http\Requests\Technologies;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyCreateRequest extends FormRequest
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
                'max:125',
                'unique:technologies,name'
            ]
        ];
    }
}
