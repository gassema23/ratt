<?php

namespace App\Http\Livewire\Geographics\Regions;

use App\Models\State;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Regions\RegionEditRequest;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PHPUnit\Framework\Constraint\Count;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $region,
        $state_id,
        $states,
        $country_id,
        $countries;
    public $emits = ['refresh'];
    public function mount($id)
    {
        $this->authorize('states-edit');
        $this->region = Region::with(['state', 'state.country'])->findOrFail($id);
        $this->countries = Country::orderBy('name')->select('id', 'name')->get();
        $this->states = State::orderBy('name')->select('id', 'name')->where('country_id', $this->region->state->country_id)->get();
        $this->state_id = $this->region->state_id;
        $this->country_id = $this->region->state->country_id;
    }
    protected function rules()
    {
        return (new RegionEditRequest)->rules($this->region->id);
    }
    public function updatedCountryId()
    {
        $this->reset(['state_id', 'states']);
        $this->states = State::orderBy('name')->select('id', 'name', 'country_id')->where('country_id', $this->country_id)->get();
    }
    public function save()
    {
        $this->authorize('states-edit');
        $this->validate();
        $this->region->update($this->validate());
        $this->saved();
    } #
    public function render()
    {
        return view('livewire.geographics.regions.edit');
    }
}
