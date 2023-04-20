<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleCreateRequest extends FormRequest
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
                'unique:roles'
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
