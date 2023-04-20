<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImageGallery extends Component
{
    public $images = [];

    public function mount($model)
    {
        $this->images = $model->getMedia('images');
    }
    public function render()
    {
        return view('livewire.image-gallery');
    }
}
