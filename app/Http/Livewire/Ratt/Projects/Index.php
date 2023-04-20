<?php

namespace App\Http\Livewire\Ratt\Projects;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('projects-list');

        return view('livewire.ratt.projects.index')
            ->layoutData([
                'title' => __('Projects'),
                'subtitle' => trans('The role of communication in successful engineering project management'),
                'action' => [
                    'name' => trans('New project'),
                    'icon' => 'plus',
                    'route' => 'ratt.projects.create',
                    'permission' => 'projects-create'
                ]
            ]);
    }
}
