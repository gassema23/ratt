<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashboard')->layoutData([
            'title' => trans('Hi :name, :time', ['name' => auth()->user()->name, 'time' => Greeting()]),
            'subtitle' => trans('Your dashboard gives you views of key performance or business process.'),
        ]);
    }
}
