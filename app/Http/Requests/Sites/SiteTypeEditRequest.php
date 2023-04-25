<?php

namespace App\Http\Requests\Sites;
use Illuminate\Foundation\Http\FormRequest;

class SiteTypeEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'site_type.name.en' => [
                'required',
                'max:125',
            ],
            'site_type.name.fr' => [
                'nullable',
                'max:125',
            ],
            'site_type.parent_id'=>[
                'nullable'
            ]
        ];
    }
}
