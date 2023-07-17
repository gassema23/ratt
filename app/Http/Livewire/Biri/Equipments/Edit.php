<?php

namespace App\Http\Livewire\Biri\Equipments;

use App\Traits\HasModal;
use App\Models\BiriEquipment;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Equipments\EquipmentEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public BiriEquipment $equipment;

    public $isUpdated = false;

    public function mount(BiriEquipment $equipment, $isUpdated = false)
    {
        $this->equipment = $equipment;
        $this->isUpdated = $isUpdated;
    }

    protected function rules()
    {
        return (new EquipmentEditRequest)->rules($this->equipment->id);
    }

    public function save()
    {
        $this->authorize('biri-equipments-update');
        $this->validate();
        $this->equipment->save();
        $this->saved();
    }
    public function render()
    {
        return view('livewire.biri.equipments.edit');
    }
}
