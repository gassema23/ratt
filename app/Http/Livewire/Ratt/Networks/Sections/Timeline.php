<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\NetworkTask;

class Timeline extends Component
{

    use AuthorizesRequests;
    protected $listeners = ['refresh' => '$refresh'];
    public $network;

    public function mount($network)
    {
        $this->authorize('networks-networkTimeline');
        $this->network = $network;
    }
    public function render()
    {
        $this->authorize('networks-networkTimeline');
        return view('livewire.ratt.networks.sections.timeline',[
            'tasks' => NetworkTask::with(['network', 'task', 'comments', 'team', 'statuses'])
                ->withCount([
                    'comments',
                    'checklists',
                    'checklists as complete_checklists_count' => function ($q) {
                        $q->where('status', 1);
                    }
                ])
                ->where('network_id', '=', $this->network->id)
                ->get()
        ]);
    }
}
