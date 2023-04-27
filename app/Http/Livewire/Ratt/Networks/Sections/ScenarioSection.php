<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Models\Task;
use App\Models\Network;
use Livewire\Component;
use App\Models\Scenario;
use App\Models\NetworkTask;
use App\Http\Requests\Networks\AssignScenarioRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ScenarioSection extends Component
{
    use AuthorizesRequests;
    protected $listeners = [
        'refresh'  => '$refresh',
    ];
    public $scenarios,
        $network,
        $scenariosData,
        $scenario_id;
    public $inputs = [];
    public function mount($id)
    {
        $this->authorize('networks-assignScenarios');
        $this->network = Network::with('networktasks')->findOrFail($id);
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
        $this->authorize('networks-assignScenarios');
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
        return view('livewire.ratt.networks.sections.scenario-section');
    }
}
