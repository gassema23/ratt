<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Severities;


use App\Traits\HasModal;

use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmSeverityEditRequest;
use App\Models\AlarmSeverity;
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
        $this->authorize('alarmSeverity-edit');
        $this->alarm = AlarmSeverity::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmSeverityEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmSeverity-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.severities.edit');
    }
}
