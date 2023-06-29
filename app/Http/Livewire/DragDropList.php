<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DragDropList extends Component
{
    public $items = ['Item 1', 'Item 2', 'Item 3', 'Item 4'];


    public function updateTaskOrder($v)
    {
        dd($v);
    }


    public function render()
    {
        return view('livewire.drag-drop-list');
    }
}
