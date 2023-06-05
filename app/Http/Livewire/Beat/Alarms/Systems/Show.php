<?php

namespace App\Http\Livewire\Beat\Alarms\Systems;

use App\Models\AlarmSystem;
use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;

class Show extends ModalComponent
{
    use HasModal;

    public $alarm;

    public function mount($id)
    {
        $this->alarm = AlarmSystem::with(['site', 'systemType'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.beat.alarms.systems.show');
    }
}
