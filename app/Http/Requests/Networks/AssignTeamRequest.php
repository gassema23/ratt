<?php

namespace App\Http\Requests\Networks;

use Illuminate\Foundation\Http\FormRequest;

class AssignTeamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'selected_teams' => [
                'min:1',
                'array'
            ],
            'selected_teams.*' => [
                'required'
            ]
        ];
    }
}
