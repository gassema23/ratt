<?php

namespace App\Http\Livewire\Biri\Assignments;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;


    public function render()
    {

        Log::info("Assignment list viewed by User:" . auth()->user()->name . '(ID:' . auth()->user()->id . ')');
        $this->authorize('biri-assignment-viewAny');

        return view('livewire.biri.assignments.index')->layoutData([
            'title' => __('Assignment list'),
            'subtitle' => trans('Assignment...'),
        ]);
    }
}
