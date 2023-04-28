<?php

namespace App\Http\Livewire\Ratt\Scenarios;

use App\Models\Team;
use App\Models\Scenario;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Scenarios\ScenarioEditRequest;
use App\Models\ScenarioTask;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $scenario, $teams;
    public $task_id = [];
    public $emits = [
        'refresh'
    ];

    public function mount($id)
    {
        $this->authorize('scenarios-update');
        $this->scenario = Scenario::findOrFail($id);
        $this->teams = Team::with('tasks')->has('tasks')->orderBy('name')->get();
        $this->task_id = ScenarioTask::where('scenario_id', $id)->pluck('task_id', 'task_id');
    }

    protected function rules()
    {
        return (new ScenarioEditRequest)->rules($this->scenario->id);
    }

    public function save()
    {
        $this->authorize('scenarios-update');
        $this->validate();
        $this->scenario->update($this->validate());
        $this->scenario->tasks()->sync(array_filter(collect($this->task_id)->toArray()));
        $this->saved();
    }
    public function render()
    {
        return view('livewire.ratt.scenarios.edit');
    }
}
