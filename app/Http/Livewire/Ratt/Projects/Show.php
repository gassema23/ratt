<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\Network;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use WireUi\Traits\Actions;
use Illuminate\Database\Eloquent\Builder;

class Show extends Component
{
    use AuthorizesRequests, Actions;
    protected $listeners = ['refresh'  => '$refresh'];

    public $project, $networks;
    public function mount($id)
    {
        $this->authorize('projects-view');
        $this->project = Project::findOrFail($id);
        $this->networks = Network::with([
            'project' => function ($q) use ($id) {
                return $q->where('id', $id);
            },
            'site',
            'site.city',
            'site.city.region',
            'site.city.region.state',
            'site.city.region.state.country'
        ])->when(!auth()->user()->hasRole(['Super-Admin', 'Admin']), function ($query) {
            $query->whereHas('networktasks', function ($q) {
                return $q->where('team_id', auth()->user()->current_team_id)->whereNull('deleted_at');
            });
        })->get();
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
                'title' => __('Project :number', ['number' => $this->project->project_no]),
                'subtitle' => trans('The role of communication in successful engineering project management'),
                'action' => [
                    'name' => trans('New network'),
                    'icon' => 'plus',
                    'id' => $this->project->id,
                    'route' => 'ratt.networks.create',
                    'permission' => 'networks-create'
                ]
            ]);
    }
}
