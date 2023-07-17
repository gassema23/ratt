<?php

namespace App\Http\Livewire\Documentations\Documentations;

use Livewire\Component;
use App\Models\Category;
use App\Models\Documentation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['change'];
    public $tag_name = '';
    public function change($name)
    {
        $this->reset('tag_name');
        $this->tag_name = $name;
    }
    public function render()
    {
        Log::info("Documentations list viewed by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        $this->authorize('documentations-viewAny');
        return view('livewire.documentations.documentations.index', [
            'categories' => Category::has('documentations')->withCount('documentations')->get(),
            'tags' => Documentation::existingTags()
        ])
            ->layoutData([
                'title' => __('Documentations'),
                'subtitle' => trans('...'),
                'action' => [
                    'name' => trans('New documentations'),
                    'icon' => 'plus',
                    'route' => 'documentations.documentations.create',
                    'permission' => 'documentations-create'
                ]
            ]);
    }
}
