<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\NetworkTask;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Activitylog\Models\Activity;

class TaskSection extends Component
{
    use AuthorizesRequests, Actions;

    protected $listeners = [
        'refresh' => '$refresh',
        'taskInfo'
    ];

    public $network, $taskInfoSection, $taskInfoSectionLogActivities;

    public function mount($network)
    {
        $this->authorize('networks-taskSection');
        $this->network = $network;
    }

    public function taskInfo($value)
    {
        $this->reset('taskInfoSection');
        $this->taskInfoSection = NetworkTask::with([
            'network',
            'network.project',
            'checklists',
            'task',
            'comments',
            'team',
            'statuses'
        ])
            ->withCount([
                'comments',
                'checklists',
                'checklists as complete_checklists_count' => function ($q) {
                    $q->where('status', 1);
                }
            ])
            ->findOrFail($value);

            $this->taskInfoSectionLogActivities = Activity::where('event','=','taskCompleted')->get()->last();

        $this->emit('showChecklist');
        $this->emit('refresh');
    }

    public function markAsCompleted($id)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you Sure?'),
            'description' => trans('Are you sure to complete this task?'),
            'acceptLabel' => trans('Yes!'),
            'method'      => 'confirmComplete',
            'params'    => $id
        ]);
    }

    public function confirmComplete($id)
    {
        $network = NetworkTask::findOrFail($id);


        $network->update([
            "is_completed" => now()
        ]);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($network)
            ->event('networkTaskCompleted')
            ->log('Mark as completed');

        $this->emit('showChecklist');
        $this->emit('refresh');
    }

    public function render()
    {
        $this->authorize('networks-taskSection');
        if (auth()->user()->hasRole(['Super-Admin', 'Admin', 'Guest'])) {
            $tasks = NetworkTask::with([
                'network',
                'task',
                'comments',
                'team',
                'statuses'
            ])
                ->withCount([
                    'comments',
                    'checklists',
                    'checklists as complete_checklists_count' => function ($q) {
                        $q->where('status', 1);
                    }
                ])
                ->where('network_id', '=', $this->network->id)
                ->paginate(12);
        } elseif (
            auth()->user()->hasRole('Manager') &&
            auth()->user()->currentTeam->getTranslation('name', 'en') === 'Planner'
        ) {
            $tasks = NetworkTask::with([
                'network',
                'task',
                'comments',
                'team',
                'statuses'
            ])
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
            $tasks = NetworkTask::with([
                'network',
                'task',
                'comments',
                'team',
                'statuses'
            ])
                ->withCount([
                    'comments',
                    'checklists',
                    'checklists as complete_checklists_count' => function ($q) {
                        $q->where('status', 1);
                    }
                ])
                ->where('network_id', '=', $this->network->id)
                ->where('team_id', auth()->user()->current_team_id)
                ->paginate(12);
        }

        return view('livewire.ratt.networks.sections.task-section', [
            'tasks' => $tasks
        ]);
    }
}
