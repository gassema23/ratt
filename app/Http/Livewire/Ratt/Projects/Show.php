<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\Network;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use WireUi\Traits\Actions;

class Show extends Component
{
    use AuthorizesRequests,Actions;
    protected $listeners = ['refresh'  => '$refresh'];

    public $project;
    public function mount($id)
    {
        $this->authorize('projects-view');
        $this->project = Project::with([
            'networks',
            'networks.site',
            'networks.site.city',
            'networks.site.city.region',
            'networks.site.city.region.state',
            'networks.site.city.region.state.country'
        ])->findOrFail($id);
    }

    public function acceptFollow(Network $network)
    {
        auth()->user()->follow($network);
        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('You successfully follow this network!'),
            'icon' => 'success'
        ]);
        $this->emitSelf('refresh');
    }

    public function acceptUnfollow(Network $network)
    {
        auth()->user()->unfollow($network);
        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('You successfully unfollow this network!'),
            'icon' => 'success'
        ]);
        $this->emitSelf('refresh');
    }

    public function render()
    {
        return view('livewire.ratt.projects.show')
            ->layoutData([
                'header' => __('Project :number', ['number' => $this->project->project_no]),
            ]);
    }
}
