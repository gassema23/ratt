<?php

namespace App\Http\Livewire\Biri\Assignments\Assignations;

use App\Traits\HasModal;
use WireUi\Traits\Actions;
use App\Models\BiriAssignment;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends ModalComponent
{
    use HasModal, AuthorizesRequests, Actions;

    protected $listeners = ['refresh' => '$refresh'];

    public $assignation, $desn_status, $desn_reason, $desn_completed_at, $desn_comment;

    public $emits = [
        'refresh'
    ];

    public function mount($id)
    {
        $this->assignation = BiriAssignment::with([
            'isq',
            'milestone',
            'activity.equipment',
            'activity.technology',
            'activity.category',
            'activity',
            'desnTech',
            'tech',
            'datas',
        ])->findOrFail($id);
        if (isset($this->assignation->lastDesnStatus()->first()->name)) {
            $this->desn_status =  $this->assignation->lastDesnStatus()->first()->name;
            $this->desn_reason =  $this->assignation->lastDesnStatus()->first()->reason;
        }
    }

    public function saveDesn()
    {
        $this->validate([
            'desn_status' => 'required',
            'desn_reason' => 'nullable',
        ]);

        $this->assignation->statuses()->create([
            'user_id' => $this->assignation->desn_user_id,
            'name' => $this->desn_status,
            'reason' => $this->desn_reason
        ]);

        $this->savedWithoutClose();
    }

    public function saveDesnComment()
    {
        $this->validate([
            'desn_comment' => 'required',
        ]);
        $this->assignation->datas()->create([
            'user_id' => $this->assignation->desn_user_id,
            'datas' => [
                'desn_comment' => $this->desn_comment,
                'desn_comment_date' => now()
            ],
        ]);
        $this->savedWithoutClose();
        $this->reset('desn_comment');
    }

    public function complete()
    {
        $this->assignation->datas()->create([
            'user_id' => $this->assignation->desn_user_id,
            'datas' => [
                'desn_completed_at' => now()
            ],
        ]);
        $this->savedWithoutClose();
    }

    public function render()
    {
        return view('livewire.biri.assignments.assignations.show');
    }
}
