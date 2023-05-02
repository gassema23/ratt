<?php

namespace App\Http\Livewire\Ratt\Networks;

use App\Traits\HasModal;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttachFiles extends ModalComponent
{
    use HasModal, WithFileUploads, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];
    public $model,
        $attachment,
        $model_id,
        $m_model;
    public function save()
    {
        $this->m_model = new $this->model();
        $this->validate([
            'attachment' => [
                'required',
                'mimes:jpeg,jpg,png,pdf',
                'max:4800'
            ]
        ]);
        $this->m_model->findOrFail($this->model_id)
            ->addMedia($this->attachment)
            ->withCustomProperties(['user_id' => auth()->id()])
            ->toMediaCollection();
        $this->saved();
        $this->reset();
    }

    public function render()
    {
        $this->authorize('networks-attachFiles');
        return view('livewire.ratt.networks.attach-files');
    }
}
