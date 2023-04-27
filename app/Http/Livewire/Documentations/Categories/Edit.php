<?php

namespace App\Http\Livewire\Documentations\Categories;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Categories\CategoryEditRequest;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];
    public $category;
    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
    }
    protected function rules()
    {
        return (new CategoryEditRequest)->rules($this->category->id);
    }
    public function save()
    {
        $this->authorize('categories-edit');
        $this->validate();
        $this->category->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        $this->authorize('categories-edit');
        return view('livewire.documentations.categories.edit');
    }
}
