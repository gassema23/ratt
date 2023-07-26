<?php

namespace App\Http\Livewire\Biri\Isq;

use App\Models\BiriIsqMasterData;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $isq;

    public function mount($id)
    {
        $this->authorize('biri-isq-view');
        $this->isq = BiriIsqMasterData::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.biri.isq.show');
    }
}
