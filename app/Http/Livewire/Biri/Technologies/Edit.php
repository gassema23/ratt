<?php

namespace App\Http\Livewire\Biri\Technologies;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Technologies\TechnologyEditRequest;
use App\Models\BiriTechnology;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public BiriTechnology $technology;

    public $isUpdated = false;

    public function mount(BiriTechnology $technology, $isUpdated = false)
    {
        $this->technology = $technology;
        $this->isUpdated = $isUpdated;
    }

    protected function rules()
    {
        return (new TechnologyEditRequest)->rules($this->technology->id);
    }

    public function save()
    {
        $this->authorize('biri-technology-update');
        $this->validate();
        $this->technology->save();
        $this->saved();
    }

    public function render()
    {
        return view('livewire.biri.technologies.edit');
    }
}
