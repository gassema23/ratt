<?php

namespace App\Http\Livewire\Ratt\Networks;

use App\Models\Site;
use App\Models\Network;
use App\Traits\HasModal;
use App\Http\Livewire\Trix;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\Networks\NetworkUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Pestopancake\LaravelBackpackNotifications\Notifications\DatabaseNotification;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;

    public $emits = [
        'refresh'
    ];

    public $network,
        $sites,
        $network_element,
        $site_id,
        $description;

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
        $this->authorize('networks-update');
        $this->network = Network::findOrFail($id);
        $this->sites = Site::orderBy('name')->select('id', 'name', 'clli')->get();
        $this->network_element = $this->network->network_element;
        $this->site_id = $this->network->site_id;
    }

    protected function rules()
    {
        return (new NetworkUpdateRequest)->rules($this->network->id, $this->network->project);
    }

    public function updatedSiteId($value)
    {
        $this->reset('network_element');
        if ($value) {
            $clli = Site::findOrFail($value);
            $this->network_element = $clli->clli;
        }
    }

    public function save()
    {
        $this->validate();
        dd($this->description);

        $this->network->update(
            [
                'site_id' => $this->site_id,
                'network_no' => $this->network->network_no,
                'network_element' => $this->network_element,
                'name' => $this->network->name,
                'description' => $this->description ?? null,
                'priority' => $this->priority ?? 3,
                'started_at' => $this->network->started_at,
                'ended_at' => $this->network->ended_at
            ]
        );

        $this->network->project->planner->notify(new DatabaseNotification(
            $type = 'info',
            $message = auth()->user()->name,
            $messageLong =  trans(' Update network :number', ['number' => $this->network->network_no]),
            $href = '/admin/ratt/networks/show/' . $this->network->id,
            $hrefText = trans('View')
        ));

        $this->network->project->prime->notify(new DatabaseNotification(
            $type = 'info',
            $message = auth()->user()->name,
            $messageLong =  trans(' Update network :number', ['number' => $this->network->network_no]),
            $href = '/admin/ratt/networks/show/' . $this->network->id,
            $hrefText = trans('View')
        ));

        $this->saved();
    }

    public function render()
    {
        return view('livewire.ratt.networks.edit');
    }
}
