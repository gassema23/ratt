<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Lists;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmListEditRequest;
use App\Models\AlarmList;
use App\Models\AlarmSeverity;
use App\Models\AlarmType;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = ['refresh'];

    public $types,
        $severities,
        $alarm;

    public function mount($id)
    {
        $this->authorize('alarmList-edit');
        $this->alarm = AlarmList::findOrFail($id);
        $this->types = AlarmType::orderBy('label')->select('id', 'label')->get();
        $this->severities = AlarmSeverity::orderBy('label')->select('id', 'label')->get();
    }

    protected function rules()
    {
        return (new AlarmListEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmList-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.lists.edit');
    }
}
