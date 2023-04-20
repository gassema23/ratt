<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\User;
use App\Models\Project;
use App\Traits\HasModal;
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
        $planners;

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
        $this->validate();
        $this->project->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.ratt.projects.edit');
    }
}
