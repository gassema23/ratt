<?php

namespace App\Http\Livewire\Biri\Activities;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        Log::info("Activities list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('biri-activities-viewAny');
        return view('livewire.biri.activities.index')
            ->layoutData([
                'title' => __('Activities list'),
                'subtitle' => trans('Activities...'),
                'action' => [
                    'name' => trans('New activity'),
                    'icon' => 'plus',
                    'route' => 'biri.activities.edit',
                    'permission' => 'biri-activities-create'
                ]
            ]);
    }
}
