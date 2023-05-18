<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Severities;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSeverityCreateRequest;
use App\Models\AlarmSeverity;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $label, $description, $code;

    protected function rules()
    {
        return (new AlarmSeverityCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmSeverity-create');
        $this->validate();
        AlarmSeverity::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmSeverity-create');
        return view('livewire.beat.settings.alarms.severities.create');
    }
}
