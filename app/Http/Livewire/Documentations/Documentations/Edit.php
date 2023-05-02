<?php

namespace App\Http\Livewire\Documentations\Documentations;

use App\Models\Category;
use App\Traits\HasModal;
use App\Http\Livewire\Trix;
use App\Models\Documentation;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Rules\ValidImportFileExtension;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Documentations\DocumentationEditRequest;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests, WithFileUploads;
    public $emits = ['refresh','refreshDocument'];
    public $documentation, $tags, $description;
    public $attachment = [];
    protected function getListeners()
    {
        return [
            Trix::EVENT_VALUE_UPDATED, // trix_value_updated(),

        ];
    }
    public function trix_value_updated($value)
    {
        $this->description = $value;
    }
    public function mount($id)
    {
        $this->authorize('documentations-edit');
        $this->documentation = Documentation::findOrFail($id);
        $this->tags = $this->documentation->tagNames();
    }
    protected function rules()
    {
        return (new DocumentationEditRequest)->rules();
    }
    public function save()
    {
        $this->authorize('documentations-edit');
        //$this->authorize('documentations-create');
        $this->validate();
        $this->documentation->update([
            'name' => $this->documentation->name,
            'category_id' => $this->documentation->category_id,
            'description' => $this->description,
        ]);
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
