<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Models\NetworkTask;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class TaskSection extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['refresh' => '$refresh'];
    public $network, $taskInfoSection;

    public function mount($network)
    {
        $this->authorize('task-section');
        $this->network = $network;
    }

    public function taskInfo($value)
    {
        $this->reset('taskInfoSection');
        $this->taskInfoSection = NetworkTask::with('network', 'network.project', 'checklists', 'task', 'comments', 'team', 'statuses')
            ->withCount([
                'comments',
                'checklists',
                'checklists as complete_checklists_count' => function ($q) {
                    $q->where('status', 1);
                }
            ])->findOrFail($value);
        $this->emit('showChecklist');
        $this->emit('refresh');
    }

    public function render()
    {
        $this->authorize('task-section');
        if (auth()->user()->hasRole(['Super-Admin', 'Admin'])) {
            $tasks = NetworkTask::with(['network', 'task', 'comments', 'team', 'statuses'])
                ->withCount([
                    'comments',
                    'checklists',
                    'checklists as complete_checklists_count' => function ($q) {
                        $q->where('status', 1);
                    }
                ])
                ->where('network_id', '=', $this->network->id)
                ->paginate(12);
        } else {
            $tasks = NetworkTask::with(['network', 'task', 'comments', 'team', 'statuses'])
            ->withCount([
                'comments',
                'checklists',
                'checklists as complete_checklists_count' => function ($q) {
                    $q->where('status', 1);
                }
            ])
            ->where('network_id', '=', $this->network->id)
            ->where('team_id',auth()->user()->current_team_id )
            ->paginate(12);
        }

        return view(
            'livewire.ratt.networks.sections.task-section',
            [
                'tasks' => $tasks
            ]
        );
    }
}
