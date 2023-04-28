<?php

namespace App\Http\Livewire\Settings\Geographics;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Sites\GeographicTypeCreateRequest;
use App\Models\GeographicType;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name;

    protected function rules()
    {
        return (new GeographicTypeCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('geographicTypes-create');
        $this->validate();
        GeographicType::create($this->validate());
        $this->saved();
    }
    public function render()
    {
        $this->authorize('geographicTypes-create');
        return view('livewire.settings.geographics.create');
    }
}
