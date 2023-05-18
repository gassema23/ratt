<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Types;

use App\Traits\HasModal;
use App\Models\AlarmType;
use App\Models\AlarmCategory;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Alarms\AlarmTypeCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $label, $description, $alarm_category_id;

    protected function rules()
    {
        return (new AlarmTypeCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmType-create');
        $this->validate();
        AlarmType::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmType-create');
        return view('livewire.beat.settings.alarms.types.create', [
            'categories' => AlarmCategory::orderBy('label')->select('id', 'label')->get()
        ]);
    }
}
