<?php

namespace App\Http\Livewire\Ratt\Scenarios;

use App\Models\Team;
use App\Models\Scenario;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Scenarios\ScenarioCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $name, $description;
    public $task_id = [];
    public $emits = [
        'refresh'
    ];

    protected function rules()
    {
        return (new ScenarioCreateRequest)->rules();
    }

    public function save()
    {
        $this->validate();
        $scenario = Scenario::create($this->validate());
        $scenario->tasks()->sync(array_filter(collect($this->task_id)->toArray()));
        $this->saved();
    }

    public function render()
    {
        $this->authorize('scenarios-create');
        return view('livewire.ratt.scenarios.create', [
            'teams' => Team::with('tasks')->has('tasks')->orderBy('name')->get()
        ]);
    }
}
