<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Specifications;

use App\Traits\HasModal;
use App\Models\AlarmSpecification;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmSpecificationEditRequest;
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
        $this->authorize('alarmSpecification-edit');
        $this->alarm = AlarmSpecification::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmSpecificationEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmSpecification-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.specifications.edit');
    }
}
