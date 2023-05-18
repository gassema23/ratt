<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Switchs;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSwitchTypeCreateRequest;
use App\Models\AlarmSwitchType;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $label,$description;

    protected function rules()
    {
        return (new AlarmSwitchTypeCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmSwitchType-create');
        $this->validate();
        AlarmSwitchType::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmSwitchType-create');
        return view('livewire.beat.settings.alarms.switchs.create');
    }
}
