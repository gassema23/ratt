<?php

namespace App\Http\Livewire\Geographics\Countries;

use App\Models\Country;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Countries\CountryEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name, $country;

    public function mount($id)
    {
        $this->authorize('countries-edit');
        $this->country = Country::findOrFail($id);
    }

    protected function rules()
    {
        return (new CountryEditRequest)->rules($this->country->id);
    }

    public function save()
    {
        $this->authorize('countries-edit');
        $this->validate();
        $this->country->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.geographics.countries.edit');
    }
}
