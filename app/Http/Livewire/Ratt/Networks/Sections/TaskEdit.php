<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Models\NetworkTask;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Networks\TaskEditRequest;

class TaskEdit extends ModalComponent
{
    use AuthorizesRequests, HasModal;
    public $networkTask, $status, $reason;
    public $emits = ['refresh'];

    public function mount($id)
    {

        $this->authorize('tasks-update');
        $this->networkTask = NetworkTask::with(['task'])->findOrFail($id);
    }

    protected function rules()
    {
        return (new TaskEditRequest)->rules();
    }

    public function save()
    {
        $this->authorize('tasks-update');
        $this->validate();
        $this->networkTask->update([
            'due_date' => $this->networkTask->due_date,
            'priority' => $this->networkTask->priority,
        ]);
        if (!is_null($this->status)) {
            $this->validate([
                'status' => ['required'],
                'reason' => ['required']
            ]);
            $this->networkTask->setStatus($this->status, $this->reason);
        }
        $this->saved();
    }

    public function render()
    {
        return view('livewire.ratt.networks.sections.task-edit');
    }
}
