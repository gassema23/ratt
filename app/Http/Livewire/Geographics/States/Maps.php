<?php

namespace App\Http\Livewire\Geographics\States;

use App\Models\State;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Maps extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $state, $countries;
    public $emits = [
        'refresh'
    ];
    public function mount($id)
    {
        $this->state = State::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.geographics.states.maps');
    }
}
