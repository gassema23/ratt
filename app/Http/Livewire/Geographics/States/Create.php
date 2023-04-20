<?php

namespace App\Http\Livewire\Geographics\States;

use App\Models\State;
use App\Models\Country;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\States\StateCreateRequest;
use App\Models\GeographicType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $name,
        $country_id,
        $latitude,
        $longitude,
        $abbr,
        $type_id;
    public $emits = ['refresh'];
    protected function rules()
    {
        return (new StateCreateRequest)->rules();
    }
    public function save()
    {
        $this->authorize('states-create');
        $this->validate();
        State::create($this->validate());
        $this->saved();
    }
    public function render()
    {
        $this->authorize('states-create');
        return view('livewire.geographics.states.create', [
            'countries' => Country::orderBy('name')->select('name', 'id')->get(),
            'types' => GeographicType::orderBy('name')->select('name', 'id')->get(),
        ]);
    }
}
