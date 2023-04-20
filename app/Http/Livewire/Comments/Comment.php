<?php

namespace App\Http\Livewire\Comments;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use WireUi\Traits\Actions;

class Comment extends Component
{
    use AuthorizesRequests, Actions;

    public $comment;

    public $isReplying = false;

    public $replyState = [
        'body' => ''
    ];

    public $isEditing = false;

    public $editState = [
        'body' => ''
    ];

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    protected $validationAttributes = [
        'replyState.body' => 'reply'
    ];

    public function updatedIsEditing($isEditing)
    {
        if (!$isEditing) {
            return;
        }
        $this->editState = [
            'body' => $this->comment->body
        ];
    }

    public function editComment()
    {
        $this->authorize('update', $this->comment);
        $this->comment->update($this->editState);
        $this->isEditing = false;
    }

    public function cancelEditComment()
    {
        $this->isEditing = false;
    }

    public function confirm($id)
    {
        $this->dialog()->confirm([
            'title'       => trans('Are you sure?'),
            'description' => trans('Are you sure you want to deactivate this item? This action cannot be undone.'),
            'icon'        => 'error',
            'accept'      => [
                'label'  => trans('Yes, delete it'),
                'method' => 'deleteComment',
                'params' => $id
            ],
            'close' => [
                'label'  => trans('Cancel'),
            ],
        ]);
    }

    public function deleteComment()
    {
        $this->authorize('destroy', $this->comment);
        $this->comment->delete();
        $this->emitUp('refresh');
    }

    public function postReply()
    {
        if (!$this->comment->hasParent()) {
            return;
        }
        $this->validate([
            'replyState.body' => 'required'
        ]);
        $reply = $this->comment->children()->make($this->replyState);
        $reply->user()->associate(auth()->user());
        $reply->commentable()->associate($this->comment->commentable);
        $reply->save();
        $this->replyState = [
            'body' => ''
        ];
        $this->isReplying = false;
        $this->emitSelf('refresh');
    }

    public function render()
    {
        return view('livewire.comments.comment');
    }
}
