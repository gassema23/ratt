<?php

namespace App\Http\Livewire\Beat\Alarms\Systems;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSystemEditRequest;
use App\Models\AlarmSystem;
use App\Models\AlarmSystemType;
use App\Models\Site;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $alarm;

    public function mount($id)
    {
        $this->authorize('alarmSystem-edit');
        $this->alarm = AlarmSystem::findOrFail($id);
    }


    public function updatedSiteId($value)
    {
        $this->reset('alarm.network_element');
        if ($value) {
            dd($value);
            $site = Site::findOrFail($value);
            $this->alarm->network_element = $site->clli;
        }
    }

    protected function rules()
    {
        return (new AlarmSystemEditRequest)->rules($this->alarm->id);
    }

    public function save()
    {
        $this->authorize('alarmSystem-edit');
        $this->validate();
        $this->alarm->update($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.beat.alarms.systems.edit', [
            'sites' => Site::orderBy('clli')->orderBy('name')->select(['id', 'clli', 'name'])->get(),
            'types' => AlarmSystemType::orderBy('label')->select('id', 'label')->get()
        ]);
    }
}
