<?php

namespace App\Http\Livewire\Ratt\Networks;

use App\Models\Site;
use App\Models\Network;
use App\Models\Project;
use App\Traits\HasModal;
use App\Http\Livewire\Trix;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Networks\NetworkCreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Pestopancake\LaravelBackpackNotifications\Notifications\DatabaseNotification;

class Create extends ModalComponent
{
    use AuthorizesRequests, HasModal;

    public
        $site_id,
        $technology_id,
        $network_no,
        $name,
        $description,
        $priority,
        $started_at,
        $ended_at,
        $project;
    public $tags = [];
    public $inputs = [];
    public $i = 1;

    protected function getListeners()
    {
        return [Trix::EVENT_VALUE_UPDATED];
    }

    public function trix_value_updated($value)
    {
        $this->description = $value;
    }

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
    }

    protected function rules()
    {
        return (new NetworkCreateRequest)->rules($this->project);
    }

    public function save()
    {
        $this->authorize('networks-create');
        $this->validate();
        $network = Network::create([
            'project_id' => $this->project->id,
            'site_id' => $this->site_id,
            'network_no' => $this->network_no,
            'network_element'=>'',
            'name' => $this->name,
            'description' => $this->description ?? null,
            'priority' => $this->priority ?? 3,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at
        ]);

        $network->tag($this->tags);

        $this->project->planner->notify(new DatabaseNotification(
            $type = 'info',
            $message = auth()->user()->name,
            $messageLong =  trans(' Add a new network on project P-:number', ['number' => $this->project->project_no]),
            $href = '/admin/ratt/networks/show/' . $network->id,
            $hrefText = trans('View')
        ));
        $this->project->prime->notify(new DatabaseNotification(
            $type = 'info',
            $message = auth()->user()->name,
            $messageLong =  trans(' Add a new network on project P-:number', ['number' => $this->project->project_no]),
            $href = '/admin/ratt/networks/show/' . $network->id,
            $hrefText = trans('View')
        ));

        return redirect()->route('admin.ratt.networks.show', $network->id);
    }

    public function render()
    {
        $this->authorize('networks-create');
        return view('livewire.ratt.networks.create', [
            'sites' => Site::orderBy('clli')->orderBy('name')->select(['id', 'clli', 'name'])->get()
        ]);
    }
}
