<?php

namespace App\Http\Requests\Equipments;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentEditRequest extends FormRequest
{
    public function rules($equipment_id): array
    {
        return [
            'equipment.label.en' => [
                'required',
                'string',
                'max:125',
                Rule::unique('biri_equipment', 'label')->ignore($equipment_id),
            ],
            'equipment.label.fr' => [
                'nullable',
                'string',
                'max:125',
                Rule::unique('biri_equipment', 'label')->ignore($equipment_id),
            ],
            'equipment.description.en' => [
                'nullable',
                'max:32768',
            ],
            'equipment.description.fr' => [
                'nullable',
                'max:32768',
            ],
        ];
    }
}
