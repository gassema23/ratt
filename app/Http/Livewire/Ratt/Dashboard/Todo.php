<?php

namespace App\Http\Livewire\Ratt\Dashboard;


use App\Models\Network;
use Livewire\Component;
use App\Models\Checklist as ModelChecklist;
use WireUi\Traits\Actions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Todo extends Component
{
    use Actions, AuthorizesRequests;

    public $model, $finishCheckList;

    protected $listeners = [
        'showChecklist' => '$refresh'
    ];

    public function render()
    {
        $todos = Network::with([
            'networktasks.task',
            'networktasks.checklists',
        ])
            ->when(!auth()->user()->hasRole(['Super-Admin', 'Admin']), function ($query) {
                $query->with('networktasks', function ($q) {
                    $q->where('team_id', auth()->user()->current_team_id)
                        ->whereNull('deleted_at');
                });
            })
            ->whereHas('followers', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->whereNull('completed_at')
            ->get();

        return view('livewire.ratt.dashboard.todo', [
            'todos' => $todos
        ]);
    }
}
