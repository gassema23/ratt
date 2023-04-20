<?php

namespace App\Http\Requests\Teams;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($team_id): array
    {
        return [
            'team.name.en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teams', 'name')->ignore($team_id)
            ],
            'team.name.fr' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('teams', 'name')->ignore($team_id)
            ],
            'team.owner_id' => ['required']
        ];
    }
}
