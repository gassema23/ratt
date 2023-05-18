<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Statuses;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmStatusCreateRequest;
use App\Models\AlarmStatus;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $label, $description;

    protected function rules()
    {
        return (new AlarmStatusCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmStatus-create');
        $this->validate();
        AlarmStatus::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmStatus-create');
        return view('livewire.beat.settings.alarms.statuses.create');
    }
}
