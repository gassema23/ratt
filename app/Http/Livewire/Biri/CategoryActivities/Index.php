<?php

namespace App\Http\Livewire\Biri\CategoryActivities;


use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {


        Log::info("Activities list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('biri-category-activities-viewAny');
        return view('livewire.biri.category-activities.index')
            ->layoutData([
                'title' => __('Category activities list'),
                'subtitle' => trans('Activities...'),
                'action' => [
                    'name' => trans('New category activity'),
                    'icon' => 'plus',
                    'route' => 'biri.category-activities.edit',
                    'permission' => 'biri-category-activities-create'
                ]
            ]);
    }
}
