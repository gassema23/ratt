<?php

namespace App\Http\Livewire\Documentations\Documentations;

use Livewire\Component;
use App\Models\Documentation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use AuthorizesRequests;
    public $documentation;
    protected function getListeners()
    {
        return ['refreshDocument' => '$refresh'];
    }
    public function mount(Documentation $slug)
    {
        $this->authorize('documentations-view');
        $this->documentation = $slug->load(['category', 'tagged', 'creator', 'comments']);
    }
    public function render()
    {
        return view('livewire.documentations.documentations.show');
    }
}
