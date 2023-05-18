<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Lists;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmListCreateRequest;
use App\Models\AlarmList;
use App\Models\AlarmSeverity;
use App\Models\AlarmType;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = ['refresh'];

    public $alarm_severity_id,
        $alarm_type_id,
        $model,
        $item_number,
        $ctl,
        $verb1,
        $verb2,
        $io_terminal,
        $document_code,
        $description;

    protected function rules()
    {
        return (new AlarmListCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmList-create');
        $this->validate();
        AlarmList::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmList-create');
        return view('livewire.beat.settings.alarms.lists.create', [
            'types' => AlarmType::orderBy('label')->select('id', 'label')->get(),
            'severities' => AlarmSeverity::orderBy('label')->select('id', 'label')->get()
        ]);
    }
}
