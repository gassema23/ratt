<?php

namespace App\Http\Livewire\Documentations\Documentations;

use Throwable;
use App\Models\Category;
use App\Traits\HasModal;
use App\Models\Documentation;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Rules\ValidImportFileExtension;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Documentations\DocumentationEditRequest;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests, WithFileUploads;
    public $emits = ['refresh'];
    public $documentation, $tags;
    public $attachment = [];
    public function mount($id)
    {
        $this->documentation = Documentation::findOrFail($id);
        $this->tags = $this->documentation->tagNames();
    }
    protected function rules()
    {
        return (new DocumentationEditRequest)->rules();
    }
    public function save()
    {
        //$this->authorize('documentations-create');
        $this->validate();
        $this->documentation->update($this->validate());
        $this->documentation->retag($this->tags);
        $this->validate([
            'attachment' => [
                'nullable',
            ],
            'attachment.*' => [
                new ValidImportFileExtension,
                'max:7800'
            ]
        ]);
        foreach ($this->attachment as $file) {
            $this->documentation->addMedia($file)
                ->withCustomProperties(['user_id' => auth()->id()])
                ->toMediaCollection();
        }
        $this->saved();
    }
    public function render()
    {
        return view('livewire.documentations.documentations.edit', [
            'categories' => Category::orderBy('name')->select('id', 'name')->get()
        ]);
    }
}
