<?php

namespace App\Http\Livewire\Documentations\Documentations;

use App\Models\Category;
use App\Traits\HasModal;
use App\Models\Documentation;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Documentations\DocumentationCreateRequest;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests, WithFileUploads;
    public $emits = ['refresh'];
    public $description, $name, $category_id, $attachment;
    public $tags = [];
    protected function rules()
    {
        return (new DocumentationCreateRequest)->rules();
    }
    public function save()
    {
        //$this->authorize('documentations-create');
        $this->validate();
        $documentation = Documentation::create($this->validate());
        $documentation->tag($this->tags);
        $this->validate([
            'attachment' => [
                'nullable',
                'mimes:jpeg,jpg,png,pdf',
                'max:7800'
            ]
        ]);
        $documentation
            ->addMedia($this->attachment)
            ->withCustomProperties(['user_id' => auth()->id()])
            ->toMediaCollection();
        $this->saved();
    }
    public function render()
    {
        //$this->authorize('documentations-create');
        return view('livewire.documentations.documentations.create', [
            'categories' => Category::orderBy('name')->select('id', 'name')->get()
        ]);
    }
}
