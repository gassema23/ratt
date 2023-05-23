<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Generators;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmGeneratorTypeEditRequest;
use App\Models\AlarmGeneratorType;

class Edit extends  ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $alarm;

    public function mount($id)
    {
        $this->authorize('alarmGeneratorType-edit');
        $this->alarm = AlarmGeneratorType::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmGeneratorTypeEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmGeneratorType-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.beat.settings.alarms.generators.edit');
    }
}
