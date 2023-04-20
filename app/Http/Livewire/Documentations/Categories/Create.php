<?php

namespace App\Http\Livewire\Documentations\Categories;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends  ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $description, $name, $parent_id;

    protected function rules()
    {
        return (new CategoryCreateRequest)->rules();
    }
    public function save()
    {
        $this->authorize('categories-create');
        $this->validate();
        Category::create($this->validate());
        $this->saved();
    }
    public function render()
    {
        $this->authorize('categories-create');
        return view('livewire.documentations.categories.create');
    }
}
