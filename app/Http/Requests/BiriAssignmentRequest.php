<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiriAssignmentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'desn_user_id'=>[
                'required'
            ],
            'desn_req'=>[
                'date',
                'after:yesterday'
            ]
        ];
    }
}
