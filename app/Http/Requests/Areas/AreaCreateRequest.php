<?php

namespace App\Http\Requests\Areas;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AreaCreateRequest extends FormRequest
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
            ],
            'name.*' => [
                UniqueTranslationRule::for ('areas')
            ],
            'state_id' => [
                'required'
            ],
        ];
    }
}
