<?php

namespace App\Http\Livewire\Geographics\Sites;

use App\Models\City;
use App\Models\Site;
use App\Models\State;
use App\Models\Region;
use App\Models\Country;
use App\Models\SiteType;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Sites\SiteCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $name,
        $clli,
        $areas,
        $area_id,
        $states,
        $state_id,
        $country_id,
        $cities,
        $city_id,
        $latitude,
        $longitude,
        $regions,
        $region_id,
        $other_site_information,
        $contact_and_site_access,
        $type_id,
        $plant,
        $manager,
        $emergency_line,
        $phone_line,
        $address;

    public $emits = [
        'refresh'
    ];

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
        return (new SiteCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('sites-create');
        $this->validate();
        Site::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('sites-create');

        return view('livewire.geographics.sites.create', [
            'countries' => Country::orderBy('name')->select('id', 'name')->get(),
            'types' => SiteType::with('parent')
                ->join('site_types as parent_types', 'parent_types.id', '=', 'site_types.parent_id')
                ->select('site_types.id', 'site_types.name', 'parent_types.name->' . app()->getLocale() . ' as parent')
                ->whereNotNull('site_types.parent_id')
                ->get()
        ]);
    }
}
