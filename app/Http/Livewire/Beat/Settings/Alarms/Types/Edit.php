<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Types;

use App\Traits\HasModal;
use App\Models\AlarmCategory;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmTypeEditRequest;
use App\Models\AlarmType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $alarm, $categories;

    public function mount($id)
    {
        $this->authorize('alarmType-edit');
        $this->alarm = AlarmType::findOrFail($id);
        $this->categories = AlarmCategory::orderBy('label')->select('id', 'label')->get();
    }

    protected function rules()
    {
        return (new AlarmTypeEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmType-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.beat.settings.alarms.types.edit');
    }
}
