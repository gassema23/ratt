<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Systems\Types;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSystemTypeEditRequest;
use App\Models\AlarmSystemType;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = ['refresh'];

    public $alarm;

    public function mount($id)
    {
        $this->authorize('alarmSystemType-edit');
        $this->alarm = AlarmSystemType::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmSystemTypeEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmSystemType-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.beat.settings.alarms.systems.types.edit');
    }
}
