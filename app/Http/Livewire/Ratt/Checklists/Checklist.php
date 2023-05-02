<?php

namespace App\Http\Livewire\Ratt\Checklists;

use Livewire\Component;
use App\Models\Checklist as ModelChecklist;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Checklist extends Component
{
    use WithPagination, Actions, AuthorizesRequests;

    protected $listeners = [
        'showChecklist' => '$refresh'
    ];

    public $model, $finishCheckList;

    public $newChecklistState = [
        'name' => ''
    ];

    protected $validationAttributes = [
        'newChecklistState.name' => 'checklist'
    ];

    public function postChecklist()
    {
        $this->validate([
            'newChecklistState.name' => 'required'
        ]);
        $checklist = $this->model->checklists()->make($this->newChecklistState);
        $checklist->user()->associate(auth()->user());
        $checklist->save();
        $this->newChecklistState = [
            'name' => ''
        ];
        $this->resetPage();
        $this->emit('showChecklist');
        $this->emit('NetworkTaskSection');
    }
    public function check($id)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you sure?'),
            'description' => trans('Are you sure you want complete the task ?'),
            'icon'        => 'success',
            'accept'      => [
                'label'  => trans('Yes, complete'),
                'method' => 'complete',
                'params' => $id
            ],
            'close' => [
                'label'  => trans('Cancel'),
            ],
        ]);
    }
    public function complete($id)
    {
        $check = ModelChecklist::findOrFail($id);
        $this->authorize('update', $check);
        $check->update(['status' => 1]);
        $this->emitSelf('showChecklist');
        $this->emitUp('NetworkTaskSection');
    }

    public function delete($id)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you sure?'),
            'description' => trans('Are you sure you want to deactivate this item? This action cannot be undone.'),
            'icon'        => 'error',
            'accept'      => [
                'label'  => trans('Yes, delete it'),
                'method' => 'deleteChecklist',
                'params' => $id
            ],
            'close' => [
                'label'  => trans('Cancel'),
            ],
        ]);
    }

    public function deleteChecklist($id)
    {
        $check = ModelChecklist::findOrFail($id);
        $this->authorize('destroy', $check);
        $check->delete();
        $this->emitUp('NetworkTaskSection');
        $this->emitSelf('showChecklist');
    }

    public function render()
    {
        $checklists = $this->model
            ->checklists()
            ->with('user')
            ->latest()
            ->paginate(8);
        return view('livewire.ratt.checklists.checklist', [
            'checklists' => $checklists
        ]);
    }
}
