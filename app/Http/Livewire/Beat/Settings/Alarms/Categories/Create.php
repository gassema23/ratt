<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Categories;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmCategoryCreateRequest;
use App\Models\AlarmCategory;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $label,$description;

    protected function rules()
    {
        return (new AlarmCategoryCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('alarmCategory-create');
        $this->validate();
        AlarmCategory::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmCategory-create');
        return view('livewire.beat.settings.alarms.categories.create');
    }
}
