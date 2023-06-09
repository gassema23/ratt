<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\User;
use App\Models\Project;
use App\Traits\HasModal;
use App\Http\Livewire\Trix;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Projects\ProjectEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $project,
        $primes,
        $planners,
        $description;

    protected function getListeners()
    {
        return [Trix::EVENT_VALUE_UPDATED];
    }

    public function trix_value_updated($value)
    {
        $this->description = $value;
    }

    public function mount($id)
    {
        $this->authorize('projects-edit');
        $this->project = Project::findOrFail($id);
        $this->primes = User::Prime()->get();
        $this->planners = User::Planner()->get();
    }

    protected function rules()
    {
        return (new ProjectEditRequest)->rules($this->project->id);
    }

    public function save()
    {
        $this->authorize('projects-edit');

        $this->project->project_no = str_replace('P-', '', $this->project->project_no);

        $this->validate();

        $this->project->update(
            [
                'planner_id' => $this->project->planner_id,
                'prime_id' => $this->project->prime_id,
                'name' => $this->project->name,
                'description' => $this->description,
                'project_no' => $this->project->project_no,
                'priority' => $this->project->priority,
                'started_at' => $this->project->started_at,
                'ended_at' => $this->project->ended_at,
            ]
        );
        $this->saved();
    }

    public function render()
    {
        return view('livewire.ratt.projects.edit');
    }
}
