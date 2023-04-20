<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($user_id): array
    {
        return [
            'user.name' => [
                'required',
                'max:255'
            ],
            'user.email'      => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user_id)
            ],
            'user.phone'   => [
                function ($attribute, $value, $fail) {
                    $pattern = '[0-9]{3}[0-9]{3}[0-9]{4}';
                    $regex = '/^(' . $pattern . ')$/u';
                    if ($value != '' && !preg_match($regex, $value)) {
                        $fail(__('Phone number is invalid'));
                    }
                }
            ],
            'user.employe_id' => [
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
        ];
    }
}
