<?php

namespace App\Http\Livewire\Settings\Settings;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    public $values;
    public function mount()
    {
        $this->authorize('settings-view');
        $this->values = settings()->all();
    }
    public function save()
    {
        $validatedData = $this->validate([
            'values.*' => 'nullable'
        ]);
        $valuestore = settings();
        foreach ($validatedData as $key => $value) {
            $valuestore->put($value);
        }
        return to_route('admin.settings.settings.index');
    }
    public function render()
    {
        return view('livewire.settings.settings.index')
        ->layoutData([
            'title' => __('Settings'),
            'subtitle' => trans('Settings are the configuration options and preferences.'),
        ]);
    }
}
