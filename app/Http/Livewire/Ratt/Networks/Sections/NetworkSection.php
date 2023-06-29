<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class NetworkSection extends Component
{
    use AuthorizesRequests;
    protected $listeners = [
        'refresh'  => '$refresh',
        'refreshAttachmentNetwork'  => '$refresh',
    ];

    public $network;

    public function mount($network)
    {
        $this->authorize('networks-networksSections');
        $this->network = $network->load('networkelements');
    }

    public function render()
    {
        $this->authorize('networks-networksSections');
        return view('livewire.ratt.networks.sections.network-section');
    }
}
