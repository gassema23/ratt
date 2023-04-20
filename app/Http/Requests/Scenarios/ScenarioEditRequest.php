<?php

namespace App\Http\Requests\Scenarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScenarioEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($scenario_id): array
    {
        return [
            'scenario.name.en' => [
                'required',
                'max:125',
                Rule::unique('scenarios', 'name')->ignore($scenario_id)
            ],
            'scenario.name.fr' => [
                'required',
                'max:125',
                Rule::unique('scenarios', 'name')->ignore($scenario_id)
            ],
            'scenario.description.en' => [
                'nullable'
            ],
            'scenario.description.fr' => [
                'nullable'
            ],
        ];
    }
}
