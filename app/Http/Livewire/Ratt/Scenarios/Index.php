<?php

namespace App\Http\Livewire\Ratt\Scenarios;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        $this->authorize('scenarios-viewAny');
        return view('livewire.ratt.scenarios.index')
            ->layoutData([
                'title' => __('Scenarios list'),
                'subtitle' => trans('Creating realistic project scenarios for accurate resource planning'),
                'action' => [
                    'name' => trans('New scenario'),
                    'icon' => 'plus',
                    'route' => 'ratt.scenarios.create',
                    'permission' => 'scenarios-create'
                ]
            ]);
    }
}
