<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Traits\HasModal;
use App\Models\NetworkTask;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Networks\NetworkChangeStatusRequest;
use Pestopancake\LaravelBackpackNotifications\Notifications\DatabaseNotification;

class ChangeStatusTasks extends ModalComponent
{
    use AuthorizesRequests, HasModal;
    public $emits = [
        'refresh'
    ];
    public $task, $reason, $status;

    public function mount($id)
    {
        $this->task = NetworkTask::findOrFail($id);
    }

    protected function rules()
    {
        return (new NetworkChangeStatusRequest)->rules();
    }

    public function save()
    {
        $this->validate();
        $this->task->setStatus($this->status, $this->reason);

        $this->task->network->project->planner->notify(new DatabaseNotification(
            $type = 'info',
            $message = auth()->user()->name,
            $messageLong =  trans(' Updated status'),
            $href = '/admin/ratt/networks/show/'.$this->task->network->id,
            $hrefText = trans('View')
        ));
        $this->task->network->project->prime->notify(new DatabaseNotification(
            $type = 'info',
            $message = auth()->user()->name,
            $messageLong =  trans(' Updated status'),
            $href = '/admin/ratt/networks/show/'.$this->task->network->id,
            $hrefText = trans('View')
        ));

        $this->saved();
    }

    public function render()
    {
        return view('livewire.ratt.networks.sections.change-status-tasks');
    }
}
