<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class Show extends Component
{

    public function see($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        auth()->user()
            ->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->markAsRead();

        return redirect()->to($notification->data['action_href']);
    }

    public function render()
    {
        return view('livewire.notifications.show', [
            'notifications' => auth()->user()->unreadNotifications
        ]);
    }
}
