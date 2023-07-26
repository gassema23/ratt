<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Models\Task;
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

    public $scenarios, $network, $scenariosData, $scenario_id;
    public $inputs = [];
    public $emits = ['refresh'];

    public function mount($id)
    {
        $this->authorize('networks-assignScenarios');
        $this->network = Network::findOrFail($id);
        $this->scenarios = Scenario::orderBy('name')
            ->select('id', 'name')
            ->get();
    }

    public function updatedScenarioId($value)
    {
        $this->reset(['scenariosData', 'inputs']);
        $this->scenariosData = Scenario::with([
            'tasks',
            'tasks.team'
        ])->where('id', $value)->get();

        foreach ($this->scenariosData as $scenario) {
            foreach ($scenario->tasks->groupBy('team.name') as $k => $v) {
                foreach ($v as $key => $task) {
                    $this->inputs[$task->id]['priority'] = 4;
                    $i = 10;
                    $date = $this->network->ended_at->subWeekdays(10)->format('Y-m-d');
                    if ($this->network->ended_at->subWeekdays(10)->format('Y-m-d') <  $this->network->started_at->format('Y-m-d')) {
                        while ($this->network->ended_at->subWeekdays($i)->format('Y-m-d') < $this->network->started_at->format('Y-m-d') ) {
                            $date   = $this->network->ended_at->subWeekdays($i)->format('Y-m-d');
                            $i --;
                        }
                    }
                    $this->inputs[$task->id]['duedate'] = $date;
                }
            }
        }
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
        $this->authorize('networks-assignScenarios');
        return view('livewire.ratt.networks.sections.assign-scenario');
    }
}
