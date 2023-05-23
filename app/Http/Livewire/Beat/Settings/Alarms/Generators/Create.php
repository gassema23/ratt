<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Generators;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmGeneratorTypeCreateRequest;
use App\Models\AlarmGeneratorType;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = ['refresh'];

    public $label,
        $prerequiste,
        $deployment_procedure,
        $emergency_contact,
        $generator_available;

    protected function rules()
    {
        return (new AlarmGeneratorTypeCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmGeneratorType-create');
        $this->validate();
        AlarmGeneratorType::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmGeneratorType-create');
        return view('livewire.beat.settings.alarms.generators.create');
    }
}
