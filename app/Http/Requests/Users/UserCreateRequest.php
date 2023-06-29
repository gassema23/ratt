<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
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
                'max:255'
            ],
            'email'      => [
                'required',
                'email',
                'regex:/(.*)@telus\.com/i',
                Rule::unique('users')
            ],
            'phone'   => [
                function ($attribute, $value, $fail) {
                    $pattern = '[0-9]{3}[0-9]{3}[0-9]{4}';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('Phone number is invalid'));
                    }
                }
            ],
            'employe_id' => [
                'required',
                'min:7',
                'max:7',
                Rule::unique('users'),
                function ($attribute, $value, $fail) {
                    $pattern = '(t|T)([0-9]{6})';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('Employe ID is invalid'));
                    }
                }
            ],
            'role_id' => [
                'required'
            ],
            'team_id' => [
                'required'
            ],
            'desn' => [
                'nullable'
            ],
            'tech_biri' => [
                'nullable'
            ]
        ];
    }
}
