<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Systems\Types;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSystemTypeCreateRequest;
use App\Models\AlarmSystemType;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = ['refresh'];

    public $label, $description;

    protected function rules()
    {
        return (new AlarmSystemTypeCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmSystemType-create');
        $this->validate();
        AlarmSystemType::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmSystemType-create');
        $this->authorize('alarmSystemType-create');
        return view('livewire.beat.settings.alarms.systems.types.create');
    }
}
