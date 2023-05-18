<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Switchs;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmSwitchTypeEditRequest;
use App\Models\AlarmSwitchType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $alarm;

    public function mount($id)
    {
        $this->authorize('alarmSwitchType-edit');
        $this->alarm = AlarmSwitchType::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmSwitchTypeEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmSwitchType-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.switchs.edit');
    }
}
