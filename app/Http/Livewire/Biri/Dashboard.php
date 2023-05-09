<?php

namespace App\Http\Livewire\Biri;

use App\Models\BiriIsq;
use App\Models\BiriMilestone;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $tables = BiriIsq::orderBy('created_at')
            ->with(['networkplans', 'milestones'])
            ->doesnthave('assignation')
            ->get();
        return view('livewire.biri.dashboard', [
            'tables' => $tables
        ])
            ->layoutData([
                'title' => trans('Suivi BIRI'),
            ]);
    }
}
