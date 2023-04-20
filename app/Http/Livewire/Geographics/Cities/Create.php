<?php

namespace App\Http\Livewire\Geographics\Cities;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Cities\CityCreateRequest;
use App\Models\Region;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $name, $clli, $states, $state_id, $country_id, $region_id, $regions, $latitude, $longitude;
    public $emits = [
        'refresh'
    ];

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
        return (new CityCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('cities-create');
        $this->validate();
        City::create($this->validate());
        $this->saved();
    }
    public function render()
    {
        $this->authorize('cities-create');
        return view('livewire.geographics.cities.create', [
            'countries' => Country::orderBy('name')->select('id', 'name')->has('states')->get()
        ]);
    }
}
