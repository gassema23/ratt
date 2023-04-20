<?php

namespace App\Http\Livewire\Ratt\Networks;

use App\Models\Network;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use AuthorizesRequests;
    public $network, $openSection;

    protected $listeners = ['NetworkShow' => '$refresh'];

    protected $queryString = [
        'openSection' => ['except' => '']
    ];

    public function mount($id)
    {
        $this->authorize('networks-view');
        $this->network = Network::with([
            'site',
            'site.city',
            'site.city.region',
            'site.city.region.state',
            'site.city.region.state.country'
        ])->findOrFail($id);
        if (is_null($this->openSection)) {
            $this->openSection = 'network';
        }
    }

    public function openSection($name)
    {
        $this->resetExcept('network');
        $this->openSection = $name;
        $this->emit(ucfirst($name) . 'Section');
    }

    public function render()
    {
        return view('livewire.ratt.networks.show')->layoutData([
            'header' => __('Network :number', ['number' => $this->network->network_no]),
        ]);
    }
}
