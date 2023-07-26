<?php

namespace App\Http\Livewire\Biri\Milestones;

use App\Models\BiriMilestone;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $milestone;

    public function mount($id)
    {
        $this->authorize('biri-milestones-view');
        $this->milestone = BiriMilestone::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.biri.milestones.show');
    }
}
