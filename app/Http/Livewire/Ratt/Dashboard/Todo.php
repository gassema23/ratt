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
        if (auth()->user()->hasRole(['Super-Admin', 'Admin'])) {
            $todos = Network::with([
                'networktasks' => function ($q) {
                    return $q->whereNull('deleted_at');
                },
                'networktasks.task',
                'networktasks.checklists'
            ])
                ->whereHas('followers', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })
                ->whereNull('completed_at')
                ->get();
        } else {
            $todos = Network::with([
                'networktasks' => function ($q) {
                    return $q->where('team_id', auth()->user()->current_team_id)->whereNull('deleted_at');
                },
                'networktasks.task',
                'networktasks.checklists'
            ])
                ->whereHas('followers', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })
                ->whereNull('completed_at')
                ->get();
        }
        return view('livewire.ratt.dashboard.todo', [
            'todos' => $todos
        ]);
    }
}
