<?php

namespace App\Http\Livewire\Geographics\States;

use App\Models\State;
use App\Models\Country;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\States\StateEditRequest;
use App\Models\GeographicType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $state, $countries, $types;

    public $emits = [
        'refresh'
    ];

    public function mount($id)
    {
        $this->authorize('states-update');
        $this->state = State::findOrFail($id);
        $this->countries = Country::orderBy('name')->select('name', 'id')->get();
        $this->types = GeographicType::orderBy('name')->select('name', 'id')->get();
    }

    protected function rules()
    {
        return (new StateEditRequest)->rules($this->state->id);
    }

    public function save()
    {
        $this->authorize('states-update');
        $this->validate();
        $this->state->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.geographics.states.edit');
    }
}
