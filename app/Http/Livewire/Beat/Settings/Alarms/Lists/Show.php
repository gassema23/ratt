<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Lists;

use App\Models\AlarmList;
use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;

class Show extends ModalComponent
{
    use HasModal;

    public $alarm;

    public function mount($id)
    {
        $this->alarm = AlarmList::with(['severity', 'type'])->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.lists.show');
    }
}
