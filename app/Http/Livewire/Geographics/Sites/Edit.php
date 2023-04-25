<?php

namespace App\Http\Livewire\Geographics\Sites;

use App\Models\City;
use App\Models\Site;
use App\Models\State;
use App\Models\Region;
use App\Models\Country;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Sites\SiteEditRequest;
use App\Models\SiteType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $states,
        $state_id,
        $country_id,
        $countries,
        $regions,
        $region_id,
        $cities,
        $city_id,
        $site,
        $types;
    public $emits = [
        'refresh'
    ];
    public function mount($id)
    {
        $this->authorize('sites-edit');
        $this->site = Site::with([
            'city',
            'city.region',
            'city.region.state',
            'city.region.state.country'
        ])->find($id);
        $this->countries = Country::orderBy('name')
            ->select('id', 'name')
            ->get();
        $this->states = State::orderBy('name')
            ->select('id', 'name')
            ->where('country_id', $this->site->city->region->state->country_id)
            ->get();
        $this->regions = Region::orderBy('name')
            ->select('id', 'name')->where('state_id', $this->site->city->region->state_id)
            ->get();
        $this->cities = City::orderBy('name')->select('id', 'name')
            ->where('region_id', $this->site->city->region_id)
            ->get();
        $this->types = SiteType::with('parent')
            ->join('site_types as parent_types', 'parent_types.id', '=', 'site_types.parent_id')
            ->select('site_types.id', 'site_types.name', 'parent_types.name->'.app()->getLocale().' as parent_name')
            ->whereNotNull('site_types.parent_id')
            ->orderBy('site_types.name')
            ->get();
        $this->country_id = $this->site->city->region->state->country_id;
        $this->state_id = $this->site->city->region->state_id;
        $this->region_id = $this->site->city->region_id;
        $this->city_id = $this->site->city_id;
    }
    public function updatedCountryId()
    {
        $this->reset([
            'state_id',
            'region_id',
            'states',
            'regions',
            'cities',
            'city_id'
        ]);
        $this->states = State::orderBy('name')
            ->select('id', 'name', 'country_id')
            ->where('country_id', $this->country_id)
            ->get();
    }
    public function updatedStateId()
    {
        $this->reset([
            'region_id',
            'regions',
            'cities',
            'city_id'
        ]);
        $this->regions = Region::orderBy('name')
            ->select('id', 'name', 'state_id')
            ->where('state_id', $this->state_id)
            ->get();
    }
    public function updatedRegionId()
    {
        $this->reset(['cities', 'city_id']);
        $this->cities = City::orderBy('name')
            ->select('id', 'name', 'region_id')
            ->where('region_id', $this->region_id)
            ->get();
    }
    protected function rules()
    {
        return (new SiteEditRequest)->rules($this->site->id);
    }
    public function save()
    {
        $this->authorize('sites-edit');
        $this->validate();
        $this->site->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.geographics.sites.edit');
    }
}
