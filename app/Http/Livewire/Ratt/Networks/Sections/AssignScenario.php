<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Models\Task;
use App\Models\Team;
use App\Models\Network;
use App\Models\Scenario;
use App\Traits\HasModal;
use App\Models\NetworkTask;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Networks\AssignScenarioRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AssignScenario extends ModalComponent
{
    use AuthorizesRequests, HasModal;
    public $emits = [
        'refresh'
    ];

    public $scenarios,
    $network,
    $scenariosData,
    $scenario_id;
    public $inputs = [];
    public function mount($id)
    {
        $this->authorize('assign-scenarios');
        $this->network = Network::findOrFail($id);
        $this->scenarios = Scenario::orderBy('name')
            ->select('id', 'name')
            ->get();
    }
    public function updatedScenarioId($value)
    {
        $this->reset(['scenariosData', 'inputs']);
        $this->scenariosData = Scenario::with(['tasks', 'tasks.team'])
            ->where('id', $value)
            ->get();
    }

    protected function rules()
    {
        return (new AssignScenarioRequest)->rules($this->network);
    }

    public function save()
    {
        $this->authorize('assign-scenarios');
        $this->validate();
        foreach ($this->inputs as $data) {
            NetworkTask::create([
                'priority' => $data['priority'],
                'due_date' => $data['duedate'],
                'task_id' => $data['task'],
                'network_id' => $this->network->id,
                'scenario_id' => $this->scenariosData->first()->id,
                'team_id' => Task::find($data['task'])->team_id
            ]);
        }
        $this->saved();
    }

    public function render()
    {
        $this->authorize('assign-scenarios');
        return view('livewire.ratt.networks.sections.assign-scenario');
    }
}
