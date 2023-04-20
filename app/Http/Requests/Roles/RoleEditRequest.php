<?php

namespace App\Http\Requests\Roles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($role_id)
    {
        return [
            'name' => [
                'required',
                'max:125',
                Rule::unique('roles', 'name')->ignore($role_id)
            ],
            'permission_id' => [
                'min:1',
                'array'
            ],
            'permission_id.*' => [
                'required'
            ],
        ];
    }
}
