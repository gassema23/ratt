<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Generators;

use App\Models\AlarmGeneratorType;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $generator;

    public function mount($id)
    {
        $this->generator = AlarmGeneratorType::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.beat.settings.alarms.generators.show');
    }
}
