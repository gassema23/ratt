<?php

namespace App\Http\Livewire\Settings\Technologies;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        $this->authorize('technologies-viewAll');
        return view('livewire.settings.technologies.index')->layoutData([
            'header' => __('Technologies'),
        ]);
    }
}
