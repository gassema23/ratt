<?php

namespace App\Http\Livewire\Geographics\Cities;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Cities\CityEditRequest;
use App\Models\Region;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $countries,
        $country_id,
        $states,
        $state_id,
        $city,
        $regions,
        $region_id;

    public function mount($id)
    {
        $this->authorize('cities-edit');
        $this->city = City::with(['region', 'region.state', 'region.state.country'])->find($id);

        $this->countries = Country::orderBy('name')->select('id', 'name')->get();
        $this->states = State::orderBy('name')->select('id', 'name')->where('country_id', $this->city->region->state->country_id)->get();
        $this->regions = Region::orderBy('name')->select('id', 'name')->where('state_id', $this->city->region->state_id)->get();

        $this->country_id = $this->city->region->state->country_id;
        $this->state_id = $this->city->region->state_id;
        $this->region_id = $this->city->region_id;
    }
    public function updatedCountryId()
    {
        $this->reset(['state_id', 'states', 'regions', 'region_id']);
        $this->states = State::orderBy('name')->select('id', 'name', 'country_id')->where('country_id', $this->country_id)->has('regions')->get();
    }
    public function updatedStateId()
    {
        $this->reset(['regions', 'region_id']);
        $this->regions = Region::orderBy('name')->select('id', 'name', 'state_id')->where('state_id', $this->state_id)->get();
    }

    protected function rules()
    {
        return (new CityEditRequest)->rules($this->city->id);
    }

    public function save()
    {
        $this->authorize('cities-edit');
        $this->validate();
        $this->city->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.geographics.cities.edit');
    }
}
