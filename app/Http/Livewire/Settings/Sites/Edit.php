<?php

namespace App\Http\Livewire\Settings\Sites;

use App\Traits\HasModal;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Sites\SiteTypeEditRequest;
use App\Models\SiteType;

class Edit extends ModalComponent
{
    use HasModal, AuthorizesRequests;
    public $emits = [
        'refresh'
    ];

    public $site_type, $parents;

    public function mount($id)
    {
        $this->authorize('sitetype-edit');
        $this->site_type = SiteType::findOrFail($id);
        $this->parents = SiteType::orderBy('name')->whereNull('parent_id')->select('id', 'name')->get();
    }

    protected function rules()
    {
        return (new SiteTypeEditRequest)->rules();
    }

    public function save()
    {
        $this->authorize('sitetype-edit');
        $this->validate();
        $this->site_type->update($this->validate());
        $this->saved();
    }
    public function render()
    {
        return view('livewire.settings.sites.edit');
    }
}
