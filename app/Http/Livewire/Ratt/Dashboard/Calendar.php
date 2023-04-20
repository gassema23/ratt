<?php

namespace App\Http\Livewire\Ratt\Dashboard;

use App\Models\Network;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Calendar extends Component
{
    public function render()
    {
        if (auth()->user()->hasRole(['Super-Admin', 'Admin'])) {
            $calendar = Network::whereHas('followers', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->select([DB::raw('#' || 'network_no' || ' - ' || 'network_element as title'), 'started_at as start', 'ended_at as end', 'id'])->get();
        } else {
            $calendar = Network::whereHas('followers', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->select([DB::raw('#' || 'network_no' || ' - ' || 'network_element as title'), 'started_at as start', 'ended_at as end', 'id'])->get();
        }
        return view('livewire.ratt.dashboard.calendar', [
            'calendar' => $calendar
        ]);
    }
}
