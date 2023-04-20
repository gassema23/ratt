<?php

namespace App\Http\Requests\Categories;

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($category_id): array
    {
        return [
            'category.name.en' => 'required|max:150',
            'category.name.fr' => 'required|max:150',
            'category.description.en' => 'nullable|max:32768',
            'category.description.fr' => 'nullable|max:32768',
        ];
    }
}
