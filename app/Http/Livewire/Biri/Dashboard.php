<?php

namespace App\Http\Livewire\Biri;

use App\Models\BiriIsq;
use App\Models\BiriMilestone;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $milestones = BiriMilestone::with('isqs')->withCount('isqs')->get();
        return view('livewire.biri.dashboard')
            ->layoutData([
                'title' => trans('BIRI'),
            ]);
    }
}
