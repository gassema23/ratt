<?php

namespace App\Http\Livewire\Settings\Technologies;

use App\Models\Technology;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Technologies\TechnologyEditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $name, $technology;
    public $emits = [
        'refresh'
    ];

    public function mount($id)
    {
        $this->authorize('technologies-edit');
        $this->technology = Technology::findOrFail($id);
    }

    protected function rules()
    {
        return (new TechnologyEditRequest)->rules($this->technology->id);
    }

    public function save()
    {
        $this->validate();
        $this->technology->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.settings.technologies.edit');
    }
}
