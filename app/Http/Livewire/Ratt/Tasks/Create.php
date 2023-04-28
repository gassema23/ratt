<?php

namespace App\Http\Livewire\Ratt\Tasks;

use App\Models\Task;
use App\Models\Team;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Tasks\TaskCreateRequest;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $name, $team_id ,$parent_id;
    public $emits = [
        'refresh'
    ];
    protected function rules()
    {
        return (new TaskCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('tasks-create');
        $this->validate();
        Task::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('tasks-create');
        return view('livewire.ratt.tasks.create', [
            'teams' => Team::orderBy('name')->select('id', 'name')->get(),
            'parents' => Task::orderBy('name')->select('id', 'name')->whereNull('parent_id')->get(),
        ]);
    }
}
