<?php

namespace App\Http\Livewire\Ratt\Networks;

use App\Models\City;
use App\Models\Site;
use App\Models\State;
use App\Models\Country;
use App\Models\Network;
use App\Models\Project;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Networks\NetworkCreateRequest;
use App\Models\Region;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends ModalComponent
{
    use AuthorizesRequests, HasModal;

    public $project_id,
    $site_id,
    $technology_id,
    $network_no,
    $network_element,
    $name,
    $description,
    $priority,
    $started_at,
    $ended_at,
    $project;

    protected function rules()
    {
        return (new NetworkCreateRequest)->rules($this->project);
    }

    public function save()
    {
        $this->validate();
        $network = Network::create([
            'project_id' => $this->project_id,
            'site_id' => $this->site_id,
            'network_no' => $this->network_no,
            'network_element' => $this->network_element,
            'name' => $this->name,
            'description' => $this->description ?? null,
            'priority' => $this->priority ?? 3,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at
        ]);
        return redirect()->route('admin.ratt.networks.show', $network->id);
    }
    public function render()
    {
        return view('livewire.ratt.networks.create',[
            'sites'=>Site::orderBy('clli')->orderBy('name')->select(['id','clli','name'])->get()
        ]);
    }
}
