<?php

namespace App\Http\Livewire\Biri\Isq;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Models\BiriIsqMasterData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public function render()
    {
        return view('livewire.biri.isq.edit');
    }
}
