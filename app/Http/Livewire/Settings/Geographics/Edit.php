<?php

namespace App\Http\Livewire\Settings\Geographics;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Sites\GeographicTypeEditRequest;
use App\Models\GeographicType;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $geographic_type;

    protected function rules()
    {
        return (new GeographicTypeEditRequest)->rules();
    }

    public function mount($id)
    {
        $this->authorize('geographicType-edit');
        $this->geographic_type = GeographicType::findOrFail($id);
    }

    public function save()
    {
        $this->authorize('geographicType-edit');
        $this->validate();
        $this->geographic_type->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.settings.geographics.edit');
    }
}
