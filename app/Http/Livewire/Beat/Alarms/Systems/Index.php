<?php

namespace App\Http\Livewire\Beat\Alarms\Systems;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('alarmSystem-viewAny');
        return view('livewire.beat.alarms.systems.index')
            ->layoutData([
                'title' => __('Alarms systems'),
                'subtitle' => '',
                'action' => [
                    'name' => trans('New system'),
                    'icon' => 'plus',
                    'route' => 'beat.alarms.systems.create',
                    'permission' => 'alarmSystem-create'
                ]
            ]);
    }
}
