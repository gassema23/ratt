<?php

namespace App\Http\Livewire\Beat\Settings;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public $openSection = '';
    protected $listeners = ['BeatSettings' => '$refresh'];

    protected $queryString = [
        'openSection' => ['except' => '']
    ];

    public function mount($parameter = null)
    {
        $this->authorize('beat-settings-view');
        if (!is_null($parameter)) {
            $this->openSection = $parameter;
        }
        if (is_null($this->openSection)) {
            $this->openSection = 'AlarmCatalog';
        }
    }

    public function openSection($name)
    {
        $this->reset();
        $this->openSection = $name;
        $this->emit(Str::studly($name) . 'Section');
    }

    public function render()
    {
        return view('livewire.beat.settings.index')
            ->layoutData([
                'title' => trans('Beat settings'),
            ]);
    }
}
