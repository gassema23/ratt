<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($permission_id): array
    {
        return [
            'permission.name' => [
                'required',
                'max:125',
                Rule::unique('permissions', 'name')->ignore($permission_id)
            ],
        ];
    }
}
