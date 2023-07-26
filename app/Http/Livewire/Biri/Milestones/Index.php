<?php

namespace App\Http\Livewire\Biri\Milestones;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        Log::info("Milestones list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('biri-milestones-viewAny');
        return view('livewire.biri.milestones.index')
            ->layoutData([
                'title' => __('PS44B'),
                'subtitle' => trans('Metrics Milestone.'),
                'action' => [
                    'name' => trans('Import file'),
                    'icon' => 'upload',
                    'route' => 'biri.milestones.import-files',
                    'permission' => 'biri-milestones-import'
                ]
            ]);
    }
}
