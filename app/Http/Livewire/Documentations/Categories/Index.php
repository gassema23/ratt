<?php

namespace App\Http\Livewire\Documentations\Categories;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('categories-viewAny');
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
