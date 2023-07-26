<?php

namespace App\Http\Livewire\Biri\Isq;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        Log::info("ISQ003 list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('biri-isq-viewAny');
        return view('livewire.biri.isq.index')
            ->layoutData([
                'title' => __('ISQ003'),
                'subtitle' => trans('Network Master Data Infoset.'),
            ]);
    }
}
