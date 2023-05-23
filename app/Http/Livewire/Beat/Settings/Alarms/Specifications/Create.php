<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Specifications;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSpecificationCreateRequest;
use App\Models\AlarmSpecification;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = ['refresh'];

    public $label, $description;

    protected function rules()
    {
        return (new AlarmSpecificationCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmSpecification-create');
        $this->validate();
        AlarmSpecification::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmSpecification-create');
        return view('livewire.beat.settings.alarms.specifications.create');
    }
}
