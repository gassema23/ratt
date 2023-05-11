<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\User;
use App\Models\Project;
use App\Traits\HasModal;
use App\Http\Livewire\Trix;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Projects\ProjectCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $name,
        $description,
        $planner_id,
        $prime_id,
        $project_no,
        $priority,
        $started_at,
        $ended_at,
        $completed_at;

    protected function getListeners()
    {
        return [Trix::EVENT_VALUE_UPDATED];
    }

    protected function rules()
    {
        return (new ProjectCreateRequest)->rules();
    }

    public function trix_value_updated($value)
    {
        $this->description = $value;
    }

    public function save()
    {
        $this->validate();
        $project = Project::create([
            'planner_id' => $this->planner_id,
            'prime_id' => $this->prime_id,
            'name' => $this->name,
            'description' => $this->description,
            'project_no' => $this->project_no,
            'priority' => $this->priority ?? 3,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
        ]);
        return redirect()->route('admin.ratt.projects.show', $project->id);
    }

    public function render()
    {
        $this->authorize('projects-create');
        return view('livewire.ratt.projects.create', [
            'planners' => User::Planner()->get(),
            'primes' => User::Prime()->get()
        ]);
    }
}
