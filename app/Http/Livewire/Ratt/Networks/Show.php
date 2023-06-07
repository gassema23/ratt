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

    public function mount($id, $parameter = null)
    {
        $this->authorize('networks-view');
        $this->network = Network::with([
            'site',
            'site.city',
            'site.city.region',
            'site.city.region.state',
            'site.city.region.state.country'
        ])
            ->when(!auth()->user()->hasRole(['Super-Admin', 'Admin', 'Guest']) && !auth()->user()->is_planner, function ($query) {
                $query->with('networktasks', function ($q) {
                    return $q->where('team_id', auth()->user()->currentTeam->id)->whereNull('deleted_at');
                });
            })->findOrFail($id);

        if (!is_null($parameter)) {
            $this->openSection = $parameter;
        }
        if (is_null($this->openSection)) {
            $this->openSection = 'network';
        }
    }

    public function openSection($name, $network)
    {
        $this->reset();
        $this->network = Network::with([
            'site',
            'site.city',
            'site.city.region',
            'site.city.region.state',
            'site.city.region.state.country'
        ])
            ->when(!auth()->user()->hasRole(['Super-Admin', 'Admin', 'Guest']) && !auth()->user()->is_planner, function ($query) {
                $query->with('networktasks', function ($q) {
                    return $q->where('team_id', auth()->user()->currentTeam->id)->whereNull('deleted_at');
                });
            })->findOrFail($network);
        $this->openSection = $name;
        $this->emit(ucfirst($name) . 'Section');
    }

    public function render()
    {
        return view('livewire.ratt.networks.show')
            ->layoutData([
                'title' => __('Network :number', ['number' => $this->network->network_no]),
                'action' => [
                    'name' => trans('Edit'),
                    'icon' => 'pencil',
                    'id' => $this->network->id,
                    'route' => 'ratt.networks.edit',
                    'permission' => 'tasks-create'
                ]
            ]);
    }
}
