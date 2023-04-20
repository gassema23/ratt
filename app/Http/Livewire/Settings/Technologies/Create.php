<?php

namespace App\Http\Livewire\Settings\Technologies;

use App\Models\Technology;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Technologies\TechnologyCreateRequest;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $name;
    public $emits = [
        'refresh'
    ];

    public function mount()
    {
        $this->authorize('technologies-create');
    }

    protected function rules()
    {
        return (new TechnologyCreateRequest)->rules();
    }

    public function save()
    {
        $this->validate();
        Technology::create($this->validate());
        $this->saved();
    }

    public function render()
    {
        return view('livewire.settings.technologies.create');
    }
}
