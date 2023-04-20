<?php

namespace App\Http\Livewire\Geographics\Regions;

use App\Models\State;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Regions\RegionCreateRequest;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $name,
        $state_id,
        $states,
        $country_id;
    public $emits = ['refresh'];
    protected function rules()
    {
        return (new RegionCreateRequest)->rules();
    }
    public function updatedCountryId()
    {
        $this->reset(['state_id', 'states']);
        $this->states = State::orderBy('name')->select('id', 'name', 'country_id')->where('country_id', $this->country_id)->get();
    }
    public function save()
    {
        $this->authorize('states-create');
        $this->validate();
        Region::create($this->validate());
        $this->saved();
    }
    public function render()
    {
        $this->authorize('states-create');
        return view('livewire.geographics.regions.create', [
            'countries' => Country::orderBy('name')->select('name', 'id')->get(),
        ]);
    }
}
