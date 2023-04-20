<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use Livewire\Component;
use App\Models\NetworkTask;

class Timeline extends Component
{
    protected $listeners = ['refresh' => '$refresh'];
    public $network;

    public function mount($network)
    {
        $this->network = $network;
    }
    public function render()
    {
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
