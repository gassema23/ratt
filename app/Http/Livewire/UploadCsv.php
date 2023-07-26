<?php

namespace App\Http\Livewire;

use App\Traits\HasModal;
use App\Models\BiriMilestone;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UploadCsv extends ModalComponent
{
    use HasModal, AuthorizesRequests, WithFileUploads;
    public $data = [];

    public function mount($data)
    {
        $this->data = $data;
    }

    public function rules()
    {
        return [
            'csv_file' => 'required|file',
            'header' => 'nullable'
        ];
    }

    function parseFile()
    {
        $cols = Schema::getColumnListing('biri_milestones');
    }

    function processImport()
    {
    }

    public function render()
    {
        return view('livewire.upload-csv');
    }
}
