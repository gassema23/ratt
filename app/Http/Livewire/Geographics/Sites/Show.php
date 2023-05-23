<?php

namespace App\Http\Livewire\Geographics\Sites;

use App\Models\Site;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $site;

    public function mount($id)
    {
        $this->site = Site::with([
            'type',
            'type.parent',
            'city',
            'city.region',
            'city.region.state',
            'city.region.state.country'
        ])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.geographics.sites.show');
    }
}
