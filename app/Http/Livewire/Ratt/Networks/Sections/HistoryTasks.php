<?php

namespace App\Http\Livewire\Ratt\Networks\Sections;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class HistoryTasks extends ModalComponent
{
    use HasModal;
    public $emits = [
        'refresh'
    ];

    public $activity_id;

    public function mount($id)
    {
        $this->activity_id = $id;
    }
    public function render()
    {
        return view('livewire.ratt.networks.sections.history-tasks', [
            'activities' => Activity::where('subject_id', $this->activity_id)
                ->where('subject_type', 'like', '%Network%')
                ->orWhere('subject_type', 'like', '%Checklist%')
                ->orWhere('subject_type', 'like', '%Comment%')
                ->paginate(5)
        ]);
    }
}
