<?php

namespace App\Http\Livewire\Geographics\Countries;

use App\Models\Country;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Countries\CountryCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name,
    $iso,
    $region,
    $capital,
    $sub_region,
    $latitude,
    $longitude;

    protected function rules()
    {
        return (new CountryCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('countries-create');
        $this->validate();
        Country::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('countries-create');
        return view('livewire.geographics.countries.create');
    }
}
