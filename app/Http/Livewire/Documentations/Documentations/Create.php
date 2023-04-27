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
use App\Http\Requests\Documentations\DocumentationCreateRequest;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests, WithFileUploads;
    public $emits = ['refresh'];
    public $description, $name, $category_id, $attachment;
    public $tags = [];
    protected $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trix_value_updated($value)
    {
        $this->description = $value;
    }
    protected function rules()
    {
        return (new DocumentationCreateRequest)->rules();
    }
    public function save()
    {
        $this->authorize('documentations-create');
        $this->validate();
        $documentation = Documentation::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ]);
        $documentation->tag($this->tags);
        if (!is_null($this->attachment)) {
            $this->validate([
                'attachment' => [
                    'nullable',
                    new ValidImportFileExtension,
                    'max:7800'
                ]
            ]);
            $documentation
                ->addMedia($this->attachment)
                ->withCustomProperties(['user_id' => auth()->id()])
                ->toMediaCollection();
        }
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
