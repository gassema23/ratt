<?php

namespace App\Http\Livewire\Biri\Activities;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Activities\ActivityEditRequest;
use App\Models\Biriactivity;
use App\Models\BiriCategoryActivity;
use App\Models\BiriEquipment;
use App\Models\BiriTechnology;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public Biriactivity $activity;
    public $technologies, $equipments, $categories;

    public $isUpdated = false;

    public function mount(Biriactivity $activity, $isUpdated = false)
    {
        $this->activity = $activity;
        $this->technologies = BiriTechnology::orderBy('label')->select('id', 'label')->get();
        $this->equipments = BiriEquipment::orderBy('label')->select('id', 'label')->get();
        $this->categories = BiriCategoryActivity::orderBy('label')->select('id', 'label')->get();
        $this->isUpdated = $isUpdated;
    }

    protected function rules()
    {
        return (new ActivityEditRequest)->rules($this->activity->id);
    }

    public function save()
    {
        $this->authorize('biri-activities-update');
        $this->validate();
        $this->activity->save();
        $this->saved();
    }

    public function render()
    {
        return view('livewire.biri.activities.edit');
    }
}
