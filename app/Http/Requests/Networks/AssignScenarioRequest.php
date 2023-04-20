<?php

namespace App\Http\Requests\Networks;

use Illuminate\Foundation\Http\FormRequest;

class AssignScenarioRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($network): array
    {
        return [
            'inputs.*.task' => 'required',
            'inputs.*.duedate' => [
                'required_with:inputs.*.task',
                'date',
                'after:tomorrow',
                'before:' . $network->ended_at
            ],
            'inputs.*.priority' => 'required_with:inputs.*.task',
        ];
    }
}
