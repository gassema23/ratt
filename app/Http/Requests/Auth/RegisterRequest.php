<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($user_id): array
    {
        return [
            'name'     => [
                'required',
                'max:255'
            ],
            'email'      => [
                'required',
                'email',
                'regex:/(.*)@telus\.com/i',
                Rule::unique('users', 'email')->ignore($user_id)
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
                Rule::unique('users', 'employe_id')->ignore($user_id),
                function ($attribute, $value, $fail) {
                    $pattern = '(t|T)([0-9]{6})';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('Employe ID is invalid'));
                    }
                }
            ],
            'password'   => [
                'required',
                'confirmed',
                //Password::min(8)->uncompromised()
            ]
        ];
    }
}
