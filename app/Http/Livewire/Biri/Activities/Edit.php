<?php

namespace App\Http\Livewire\Biri\Activities;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Activities\ActivityEditRequest;
use App\Models\BiriActivity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = ['refresh'];

    public $biri_activity, $technologies, $activities, $equipments;

    public function mount($id)
    {
        $this->authorize('activities-edit');
        $this->biri_activity = BiriActivity::findOrFail($id);
        $this->technologies = collect(BiriActivity::biriTechnologies())->toArray();
        $this->activities = collect(BiriActivity::biriActivities())->toArray();
        $this->equipments = collect(BiriActivity::biriEquipments())->toArray();
    }

    protected function rules()
    {
        return (new ActivityEditRequest)->rules();
    }
    public function save()
    {
        $this->authorize('activities-edit');
        $this->validate();
        $this->biri_activity->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.biri.activities.edit');
    }
}
