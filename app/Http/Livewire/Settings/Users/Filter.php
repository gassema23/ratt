<?php

namespace App\Http\Livewire\Settings\Users;

use App\Models\User;
use Livewire\Component;

class Filter extends Component
{
    public $filter_name = 'active';

    protected $queryString = [
        'filter_name' =>
        ['except' => '', 'as' => 'filter']
    ];

    public function filter($name)
    {
        $this->reset('filter_name');
        $this->filter_name = $name;
        $this->emit('filter_status_table', $name);
    }
    public function render()
    {
        return view('livewire.settings.users.filter', [
            'filter_lists' => User::filterStatus()
        ]);
    }
}
