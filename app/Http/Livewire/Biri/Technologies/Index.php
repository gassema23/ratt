<?php

namespace App\Http\Livewire\Biri\Technologies;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        Log::info("Technologies list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('biri-technologies-viewAny');
        return view('livewire.biri.technologies.index')
            ->layoutData([
                'title' => __('Technologies list'),
                'subtitle' => trans('Technologies...'),
                'action' => [
                    'name' => trans('New technology'),
                    'icon' => 'plus',
                    'route' => 'biri.technologies.edit',
                    'permission' => 'biri-technologies-create'
                ]
            ]);
    }
}
