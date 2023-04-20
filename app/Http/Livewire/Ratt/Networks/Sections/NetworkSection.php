<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use Livewire\Component;

class NetworkSection extends Component
{
    protected $listeners = [
        'refresh'  => '$refresh',
        'refreshAttachmentNetwork'  => '$refresh',
];

    public $network;

    public function mount($network)
    {
        $this->network = $network;
    }

    public function render()
    {
        return view('livewire.ratt.networks.sections.network-section');
    }
}
