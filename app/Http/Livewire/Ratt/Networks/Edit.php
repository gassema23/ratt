<?php

namespace App\Http\Livewire\Ratt\Networks;

use App\Models\Network;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Networks\NetworkUpdateRequest;
use App\Models\Site;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];
    public
    $network,
    $sites,
    $network_element,
    $site_id;

    public function mount($id)
    {
        $this->authorize('networks-edit');
        $this->network = Network::findOrFail($id);
        $this->sites = Site::orderBy('name')->select('id', 'name', 'clli')->get();
        $this->network_element = $this->network->network_element;
        $this->site_id = $this->network->site_id;
    }

    protected function rules()
    {
        return (new NetworkUpdateRequest)->rules($this->network->id);
    }

    public function updatedSiteId($value)
    {
        $this->reset('network_element');
        if ($value) {
            $clli = Site::findOrFail($value);
            $this->network_element = $clli->clli;
        }
    }

    public function save()
    {
        $this->validate();
        $this->network->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.ratt.networks.edit');
    }
}
