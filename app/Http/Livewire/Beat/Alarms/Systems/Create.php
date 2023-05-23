<?php

namespace App\Http\Livewire\Beat\Alarms\Systems;

use LivewireUI\Modal\ModalComponent;
use App\Traits\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Alarms\AlarmSystemCreateRequest;
use App\Models\AlarmSystem;
use App\Models\AlarmSystemType;
use App\Models\Site;

class Create extends  ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $site_id,
        $alarm_system_type_id,
        $network_element,
        $location_number,
        $description,
        $ipv4;

    protected function rules()
    {
        return (new AlarmSystemCreateRequest)->rules();
    }

    public function updatedSiteId($value)
    {
        $this->reset('network_element');
        if ($value) {
            $site = Site::findOrFail($value);
            $this->network_element = $site->clli;
        }
    }

    public function save()
    {
        $this->authorize('alarmSystem-create');
        $this->validate();
        AlarmSystem::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        $this->authorize('alarmSystem-create');
        return view('livewire.beat.alarms.systems.create', [
            'sites' => Site::orderBy('clli')->orderBy('name')->select(['id', 'clli', 'name'])->get(),
            'types' => AlarmSystemType::orderBy('label')->select('id', 'label')->get()
        ]);
    }
}
