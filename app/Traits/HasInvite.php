<?php

namespace App\Traits;

use App\Models\User;
use WireUi\Traits\Actions;
use App\Mail\MemberInvitation;
use Mpociot\Teamwork\TeamInvite;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait HasInvite
{
    use Actions, AuthorizesRequests;

    public function resendinvite($id)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you sure?'),
            'description' => trans('Are you sure you want to resend a validation link ?'),
            'icon'        => 'question',
            'accept'      => [
                'label'  => trans('Yes, resend'),
                'method' => 'resend',
                'params' => $id
            ],
            'close' => [
                'label'  => trans('Cancel'),
            ],
        ]);
    }


    public function resend($id)
    {
        $user = User::findOrFail($id);
        $invite = TeamInvite::where('email',$user->email)->first();
        Mail::to($invite->email)->send(new MemberInvitation($invite->team, auth()->user(), $invite));
        $this->notification()->send([
            'title' => trans('Success'),
            'description' => trans('Invitation link send successfully!'),
            'icon' => 'success'
        ]);
        $this->emitSelf($this->emits);
    }
}
