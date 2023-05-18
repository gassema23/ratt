<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Categories;

use App\Traits\HasModal;
use App\Models\AlarmCategory;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmCategoryEditRequest;
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
        $this->authorize('alarmCategory-edit');
        $this->alarm = AlarmCategory::findOrFail($id);
    }

    protected function rules()
    {
        return (new AlarmCategoryEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmCategory-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.beat.settings.alarms.categories.edit');
    }
}
