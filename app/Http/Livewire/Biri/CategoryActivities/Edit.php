<?php

namespace App\Http\Livewire\Biri\CategoryActivities;

use App\Http\Requests\CategoryActivities\CategoryActivityEditRequest;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Models\BiriCategoryActivity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public BiriCategoryActivity $categoryactivity;

    public $isUpdated = false;

    public function mount(BiriCategoryActivity $categoryactivity, $isUpdated = false)
    {
        $this->categoryactivity = $categoryactivity;
        $this->isUpdated = $isUpdated;
    }

    protected function rules()
    {
        return (new CategoryActivityEditRequest())->rules($this->categoryactivity->id);
    }

    public function save()
    {
        $this->authorize('biri-category-activities-update');
        $this->validate();
        $this->categoryactivity->save();
        $this->saved();
    }

    public function render()
    {
        return view('livewire.biri.category-activities.edit');
    }
}
