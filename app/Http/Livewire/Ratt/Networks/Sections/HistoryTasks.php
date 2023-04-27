<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HistoryTasks extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $activity_id;

    public function mount($id)
    {
        $this->authorize('networks-historyTask');
        $this->activity_id = $id;
    }
    public function render()
    {
        $this->authorize('networks-historyTask');
        return view('livewire.ratt.networks.sections.history-tasks', [
            'activities' => Activity::where('subject_id', $this->activity_id)
                ->where('subject_type', 'like', '%Network%')
                ->orWhere('subject_type', 'like', '%Checklist%')
                ->orWhere('subject_type', 'like', '%Comment%')
                ->paginate(5)
        ]);
    }
}
