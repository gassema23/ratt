<?php

namespace App\Http\Livewire\Geographics\Sites;

use App\Models\Site;
use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Maps extends ModalComponent
{
    use AuthorizesRequests;
    public $site;
    public $emits = [
        'refresh'
    ];
    public function mount($id)
    {
        $this->site = Site::findOrFail($id);
    }


    public function close()
    {
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.geographics.sites.maps');
    }
}
