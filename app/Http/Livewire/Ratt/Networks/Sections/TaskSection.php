<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\NetworkTask;
use App\Models\Team;
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

    /**
     * mount
     *
     * @param  mixed $network
     * @return void
     */
    public function mount($network)
    {
        $this->authorize('networks-taskSection');
        $this->network = $network;
    }

    /**
     * taskInfo
     *
     * @param  mixed $value
     * @return void
     */
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

        $this->taskInfoSectionLogActivities = Activity::where('event', '=', 'networkTaskCompleted')
            ->where('subject_id', $value)
            ->orderBy('created_at', 'desc')
            ->first();

        $this->emit('showChecklist');
        $this->emit('refresh');
    }

    /**
     * rollback
     *
     * @param  mixed $id
     * @return void
     */
    public function rollback($id)
    {
        if (!auth()->user()->hasAnyRole(['Super-Admin', 'Admin'])) {
            return abort(403);
        }
        $this->dialog()->confirm([
            'title'       => trans('Are you Sure?'),
            'description' => trans('Are you sure to rollback this task?'),
            'acceptLabel' => trans('Yes!'),
            'method'      => 'confirmRollback',
            'params'    => $id
        ]);
    }

    /**
     * confirmRollback
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmRollback($id)
    {
        $network = NetworkTask::findOrFail($id);
        $network->update([
            "is_completed" => null
        ]);
        activity()
            ->causedBy(auth()->user())
            ->performedOn($network)
            ->event('networkTaskRollback')
            ->log('Rollback task');

        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('Data has successfully rollback!'),
            'icon' => 'success'
        ]);

        $this->emit('showChecklist');
        $this->emit('refresh');

        //dd($network);///
    }

    /**
     * markAsCompleted
     *
     * @param  mixed $id
     * @return void
     */
    public function markAsCompleted($id)
    {
        if (!auth()->user()->is_prime) {
            $this->authorize('networks-markAsCompleted');
        }

        $this->dialog()->confirm([
            'title'       => trans('Are you Sure?'),
            'description' => trans('Are you sure to complete this task?'),
            'acceptLabel' => trans('Yes!'),
            'method'      => 'confirmComplete',
            'params'    => $id
        ]);
    }

    /**
     * confirmComplete
     *
     * @param  mixed $id
     * @return void
     */
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

        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('Tasks is now set as completed!'),
            'icon' => 'success'
        ]);

        $this->emit('showChecklist');
        $this->emit('refresh');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $network_id = $this->network->id;
        $this->authorize('networks-taskSection');
        $query = NetworkTask::with([
            'network',
            'task.parent',
            'comments',
            'team',
            'task',
            'task.networktask',
            'task.parent.networktask' =>
            function ($q) use ($network_id) {
                $q->where('network_id', $network_id);
            }
        ])->withCount([
            'comments', 'checklists', 'checklists as complete_checklists_count' => function ($q) {
                $q->where('status', 1);
            }
        ]);

        $query->when(
            (auth()->user()->hasRole(['Super-Admin', 'Admin', 'Guest'])) ||
                (auth()->user()->hasRole('Manager') && auth()->user()->is_planner),
            function ($q) use ($network_id) {
                return $q->where('network_id', $network_id);
            }
        );
        $query->when(
            (!auth()->user()->hasRole(['Super-Admin', 'Admin', 'Guest'])) ||
                (auth()->user()->hasRole('Manager') && !auth()->user()->is_planner),
            function ($q) use ($network_id) {
                return $q->where('network_id', $network_id)
                    ->where('team_id', auth()->user()->current_team_id);
            }
        );

        $tasks = $query->get();

        return view('livewire.ratt.networks.sections.task-section', [
            'tasks' => $tasks
        ]);
    }
}
