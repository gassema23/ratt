<?php

namespace App\Http\Livewire\Comments;

use App\Models\Network;
use App\Models\NetworkTask;
use Livewire\Component;
use Livewire\WithPagination;
use Pestopancake\LaravelBackpackNotifications\Notifications\DatabaseNotification;

class Comments extends Component
{
    use WithPagination;

    public $model;

    public $newCommentState = [
        'body' => ''
    ];

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected $validationAttributes = [
        'newCommentState.body' => 'comment'
    ];

    public function postComment()
    {
        $this->validate([
            'newCommentState.body' => 'required'
        ]);
        $comment = $this->model->comments()->make($this->newCommentState);
        $comment->user()->associate(auth()->user());
        $comment->save();
        if ($this->model instanceof NetworkTask) {
            $this->model->project->planner->notify(new DatabaseNotification(
                $type = 'info',
                $message = auth()->user()->name,
                $messageLong =  trans(' Add a new comment'),
                $href = '/admin/networks/show/' . $this->model->id,
                $hrefText = trans('View')
            ));
            $this->model->project->prime->notify(new DatabaseNotification(
                $type = 'info',
                $message = auth()->user()->name,
                $messageLong =  trans(' Add a new comment'),
                $href = '/admin/networks/show/' . $this->model->id,
                $hrefText = trans('View')
            ));
        }
        $this->newCommentState = [
            'body' => ''
        ];
        $this->resetPage();
    }

    public function render()
    {
        $comments = $this->model
            ->comments()
            ->with('user', 'children.user', 'children.children')
            ->parent()
            ->latest()
            ->paginate(3);

        return view('livewire.comments.comments', [
            'comments' => $comments
        ]);
    }
}
