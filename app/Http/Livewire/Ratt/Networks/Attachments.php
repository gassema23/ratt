<?php

namespace App\Http\Livewire\Ratt\Networks;

use Livewire\Component;
use WireUi\Traits\Actions;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Attachments extends Component
{
    use Actions, AuthorizesRequests;

    protected $listeners = ['refresh'  => '$refresh'];
    public $model;
    public $collection = 'default';
    public function confirm($file)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you sure?'),
            'description' => trans('Are you sure you want to deactivate this item? This action cannot be undone.'),
            'icon'        => 'error',
            'accept'      => [
                'label'  => trans('Yes, delete it'),
                'method' => 'destroy',
                'params' => $file
            ],
            'close' => [
                'label'  => trans('Cancel'),
            ],
        ]);
    }
    public function download(Media $mediaItem)
    {
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }
    public function destroy(Media $file)
    {
        $this->authorize('destroy', $file);
        $file->delete();
        $this->notification()->send([
            'title' => __('Success'),
            'description' => __('Data remove successfully!'),
            'icon' => 'success'
        ]);
        $this->emit('refresh');
        $this->emitSelf('AttachmentNetwork');
    }
    public function render()
    {
        return view('livewire.ratt.networks.attachments', [
            'files' => $this->model->getMedia($this->collection)
        ]);
    }
}
