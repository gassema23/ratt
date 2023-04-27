<?php

namespace App\Http\Livewire\Ratt\Dashboard;


use App\Models\Network;
use Livewire\Component;
use App\Models\Checklist as ModelChecklist;
use WireUi\Traits\Actions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Todo extends Component
{
    use Actions, AuthorizesRequests;

    public $model, $finishCheckList;

    protected $listeners = [
        'showChecklist' => '$refresh'
    ];

    public function check($id)
    {
        $this->dialog()->confirm([
            'title' => trans('Are you sure?'),
            'description' => trans('Are you sure you want complete the task ?'),
            'icon' => 'success',
            'accept' => [
                'label' => trans('Yes, complete'),
                'method' => 'complete',
                'params' => $id
            ],
            'close' => [
                'label' => trans('Cancel'),
            ],
        ]);
    }
    public function complete($id)
    {
        $check = ModelChecklist::findOrFail($id);
        $check->update(['status' => 1]);
        $this->emitSelf('showChecklist');
    }

    public function uncheck($id)
    {
        $this->dialog()->confirm([
            'title' => trans('Are you sure?'),
            'description' => trans('Are you sure you want uncomplete the task ?'),
            'icon' => 'success',
            'accept' => [
                'label' => trans('Yes, uncomplete'),
                'method' => 'uncomplete',
                'params' => $id
            ],
            'close' => [
                'label' => trans('Cancel'),
            ],
        ]);
    }

    public function uncomplete($id)
    {
        $check = ModelChecklist::findOrFail($id);
        $check->update(['status' => 0]);
        $this->emitSelf('showChecklist');
    }

    public function delete($id)
    {
        $this->dialog()->confirm([
            'title' => trans('Are you sure?'),
            'description' => trans('Are you sure you want to deactivate this item? This action cannot be undone.'),
            'icon' => 'error',
            'accept' => [
                'label' => trans('Yes, delete it'),
                'method' => 'deleteChecklist',
                'params' => $id
            ],
            'close' => [
                'label' => trans('Cancel'),
            ],
        ]);
    }

    public function deleteChecklist($id)
    {
        $check = ModelChecklist::findOrFail($id);
        $check->delete();
        $this->emitSelf('showChecklist');
    }

    public function render()
    {
        if (auth()->user()->hasRole(['Super-Admin', 'Admin'])) {
            $todos = Network::with([
                'networktasks',
                'networktasks.task',
                'networktasks.checklists'
            ])
                ->whereHas('followers', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })
                ->whereNull('completed_at')
                ->get();
        } else {
            $todos = Network::with([
                'networktasks'=>function($q){return $q->where('team_id', auth()->user()->current_team_id);},
                'networktasks.task',
                'networktasks.checklists'
            ])
                ->whereHas('followers', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })
                ->whereNull('completed_at')
                ->get();
        }
        return view('livewire.ratt.dashboard.todo', [
            'todos' => $todos
        ]);
    }
}
