<?php

namespace App\Http\Livewire\Settings\Users;

use App\Models\User;
use App\Models\Network;
use Livewire\Component;
use App\Models\NetworkTask;
use App\Models\Project;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use AuthorizesRequests;
    public $user_id;
    protected $listeners = ['refresh' => '$refresh'];

    public function mount($id)
    {
        $this->authorize('users-view');
        $this->user_id = $id;
    }
    public function render()
    {
        $user = User::with('roles')->findOrFail($this->user_id);
        $activities = Activity::where('causer_id', $user->id)
        ->with('subject')
            ->latest()
            ->take(10)
            ->get();
        $projects = Project::with([
            'networks',
            'networks.networktasks.task',
            'networks.networktasks' => function ($q) use ($user) {
                $q->when(!$user->hasAnyRole('Admin', 'Super-Admin'), function ($q) use ($user) {
                    $q->where('team_id', $user->current_team_id)->has('task');
                }
                )->withCount('checklists', 'checklistscompletes', 'comments');
            }
        ])->when($user->hasRole('Admin'), function ($q) use ($user) {
            $q->where('prime_id', $user->id)->orWhere('planner_id', $user->id);
        })->paginate();

        return view('livewire.settings.users.show', [
                    'activities' => $activities,
                    'projects' => $projects,
                    'user' => $user
                ])->layoutData([
                'title' => trans(':Name', ['name' => $user->name]),
                'subtitle' => trans('Here you can find employee informations.'),
            ]);
    }
}
