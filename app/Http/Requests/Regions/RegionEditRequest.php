<?php

namespace App\Http\Requests\Regions;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegionEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($region_id): array
    {
        return [
            'state_id'=>[
                'required'
            ],
            'region.name.en' => [
                'required',
                'max:125',
                Rule::unique('regions', 'name')->ignore($region_id)
            ],
            'region.name.fr' => [
                'nullable',
                'max:125',
                Rule::unique('regions', 'name')->ignore($region_id)
            ],
        ];
    }
}
