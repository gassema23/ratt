<?php

namespace App\Http\Livewire\Beat\Alarms\Alarms;

use App\Models\AlarmSystemType;
use Livewire\Component;
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
        $this->authorize('alarms-view');
        if (!is_null($parameter)) {
            //$this->openSection = $parameter;
        }
        if (is_null($this->openSection)) {
           // $this->openSection = 'AlarmCatalog';
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
        $this->authorize('alarms-viewAny');
        return view('livewire.beat.alarms.alarms.index', [
            'systems' => AlarmSystemType::orderBy('label')->select('label', 'id')->get()
        ])
            ->layoutData([
                'title' => __('Alarms'),
                'subtitle' => '',
                'action' => [
                    'name' => trans('New alarm'),
                    'icon' => 'plus',
                    'route' => 'beat.alarms.alarms.create',
                    'permission' => 'alarms-create'
                ]
            ]);
    }
}
