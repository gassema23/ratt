<?php

namespace App\Http\Livewire\Ratt\Tasks;

use App\Models\Task;
use App\Models\Team;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Tasks\TaskEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $task, $parents, $teams;
    public $emits = [
        'refresh'
    ];

    public function mount($id)
    {
        $this->authorize('tasks-update');
        $this->task = Task::findOrFail($id);
        $this->parents = Task::orderBy('name')
            ->select('id', 'name')
            ->whereNotIn('id', [$id])
            ->get();
        $this->teams = Team::orderBy('name')
            ->select('id', 'name')
            ->get();
    }

    protected function rules()
    {
        return (new TaskEditRequest)->rules($this->task->id);
    }

    public function save()
    {
        $this->authorize('tasks-update');
        $this->validate();
        $this->task->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.ratt.tasks.edit');
    }
}
