<?php

namespace App\Traits;

use Livewire\WithPagination;
use WireUi\Traits\Actions;

trait HasModal
{
    use Actions, WithPagination;

    public function close()
    {
        $this->resetPage();
        $this->forceClose()->closeModal();
    }

    public function saved()
    {
        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('Data saved successfully!'),
            'icon' => 'success'
        ]);
        foreach ($this->emits as $emit) {
            $this->emit($emit);
        }
        $this->resetPage();
        $this->close();
    }
}
