<?php

namespace App\Http\Requests\Networks;

use Illuminate\Foundation\Http\FormRequest;

class AttachFileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'medias' => [
                'required',
                'file',
                'mimes:pdf,docx,doc,jpg,png,jpeg'
            ]
        ];
    }
}
