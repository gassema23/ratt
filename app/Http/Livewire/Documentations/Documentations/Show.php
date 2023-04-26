<?php

namespace App\Http\Livewire\Documentations\Documentations;

use App\Models\Documentation;
use Livewire\Component;

class Show extends Component
{
    public $documentation;
    protected function getListeners()
    {
        return [
            'refreshDocument' => '$refresh'

        ];
    }
    public function mount(Documentation $slug)
    {
        $this->documentation = $slug->load(['category', 'tagged', 'creator','comments']);
    }
    public function render()
    {
        return view('livewire.documentations.documentations.show');
    }
}
