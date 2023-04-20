<?php

namespace App\Http\Livewire\Documentations\Categories;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.documentations.categories.index')
        ->layoutData([
            'title' => __('Categories list'),
            'subtitle' => trans('Categories...'),
            'action' => [
                'name' => trans('New category'),
                'icon' => 'plus',
                'route' => 'documentations.categories.create',
                'permission' => 'categories-create'
            ]
        ]);
    }
}
