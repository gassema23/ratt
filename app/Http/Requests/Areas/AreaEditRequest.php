<?php

namespace App\Http\Requests\Areas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreaEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($area_id): array
    {
        return [
            'area.name.en' => [
                'required',
                'max:125',
                Rule::unique('areas', 'name')->ignore($area_id)
            ],
            'area.name.fr' => [
                'required',
                'max:125',
                Rule::unique('areas', 'name')->ignore($area_id)
            ],
            'state_id' => [
                'required',
            ],
        ];
    }
}
