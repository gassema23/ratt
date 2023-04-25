<?php

namespace App\Http\Livewire\Settings\Sites;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Sites\SiteTypeCreateRequest;
use App\Models\SiteType;

class Create extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $name, $parent_id;


    protected function rules()
    {
        return (new SiteTypeCreateRequest)->rules();
    }

    public function save()
    {
        $this->authorize('sitetype-create');
        $this->validate();
        SiteType::create($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.settings.sites.create',[
            'parents'=> SiteType::orderBy('name')->whereNull('parent_id')->select('id','name')->get()
        ]);
    }
}
