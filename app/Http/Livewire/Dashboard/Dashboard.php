<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Permission;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashboard', [
            'permissions' => Permission::groupedPermission()
        ])
            ->layoutData([
                'title' => trans('Hi :name, :time', ['name' => auth()->user()->name, 'time' => Greeting()]),
                'subtitle' => trans('Your dashboard gives you views of key performance or business process.'),
            ]);
    }
}
