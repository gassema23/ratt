<?php

namespace App\Http\Requests\Sites;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($site_id): array
    {
        return [
            'city_id' => [
                'required'
            ],
            'site.type_id' => [
                'required'
            ],
            'site.name.en' => [
                'required',
                'max:125',
            ],
            'site.name.fr' => [
                'nullable',
                'max:125',
            ],
            'site.clli' => [
                'required',
                'max:15',
                Rule::unique('sites', 'clli')->ignore($site_id)
            ],
            'site.address' => [
                'nullable',
                'max:255'
            ],
            'site.latitude' => [
                'nullable',
                'between:-50,50'
            ],
            'site.longitude' => [
                'nullable',
                'between:-90,90'
            ],
            'site.phone_line' => [
                'nullable',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
            'site.emergency_line' => [
                'nullable',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
            'site.manager' => [
                'nullable',
                'max:255'
            ],
            'site.plant' => [
                'nullable',
                'numeric'
            ],
            'site.contact_and_site_access.en' => [
                'nullable',
            ],
            'site.contact_and_site_access.fr' => [
                'nullable',
            ],
            'site.other_site_information.en' => [
                'nullable',
            ],
            'site.other_site_information.fr' => [
                'nullable',
            ],
        ];
    }
}
