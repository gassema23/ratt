<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\User;
use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Projects\ProjectCreateRequest;
use App\Traits\HasModal;
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

    protected function rules()
    {
        return (new ProjectCreateRequest)->rules();
    }

    public function save()
    {
        $this->validate();
        $project = Project::create($this->validate());
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
