<?php

namespace App\Http\Livewire\Ratt\Dashboard;

use App\Models\Network;
use App\Models\Project;
use Livewire\Component;
use App\Models\NetworkTask;

class Dashboard extends Component
{
    public function render()
    {
        if (auth()->user()->hasRole(['Super-Admin', 'Admin'])) {
            $project_count = Project::count();
            $network_count = Network::count();
            $task_count = NetworkTask::count();
            $task_complete_count = NetworkTask::whereNotNull('is_completed')->count();
        } else {
            $project_count = Project::whereHas('networks.networkTasks', function ($query) {
                $query->where('team_id', auth()->user()->current_team_id);
            })->count();
            $network_count = Network::whereHas('networkTasks', function ($query) {
                $query->where('team_id', auth()->user()->current_team_id);
            })->count();
            $task_count = NetworkTask::where('team_id', auth()->user()->current_team_id)->count();
            $task_complete_count = NetworkTask::where('team_id', auth()->user()->current_team_id)->whereNotNull('is_completed')->count();
        }
        $progress = $task_count - $task_complete_count;

        return view('livewire.ratt.dashboard.dashboard', [
            'project_count' => $project_count,
            'network_count' => $network_count,
            'task_count' => $task_count,
            'task_complete_count' => $task_complete_count,
            'progress' => $progress
        ]);
    }
}
