<?php

namespace App\Http\Requests\Categories;

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:150',
            'description' => 'nullable|max:32768',
        ];
    }
}
