<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Statuses;

use App\Traits\HasModal;

use App\Models\AlarmStatus;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmStatusEditRequest;
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
        $this->authorize('alarmStatus-edit');
        $this->alarm = AlarmStatus::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmStatusEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmStatus-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.statuses.edit');
    }
}
