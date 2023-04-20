<?php

namespace App\Http\Livewire\Ratt\Tasks;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        $this->authorize('tasks-list');
        return view('livewire.ratt.tasks.index')
            ->layoutData([
                'title' => __('Tasks list'),
                'subtitle' => trans('Creating clear and concise project tasks for better team performance'),
                'action' => [
                    'name' => trans('New task'),
                    'icon' => 'plus',
                    'route' => 'ratt.tasks.create',
                    'permission' => 'tasks-create'
                ]
            ]);
    }
}
