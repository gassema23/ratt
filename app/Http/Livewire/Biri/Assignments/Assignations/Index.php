<?php

namespace App\Http\Livewire\Biri\Assignments\Assignations;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.biri.assignments.assignations.index')
            ->layoutData([
                'title' => __('BIRI tracking'),
                'subtitle' => trans('Biri network tracking tool...'),
            ]);
    }
}
