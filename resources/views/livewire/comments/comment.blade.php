<div>
    <div class="flex">
        <div class="flex-shrink-0 mr-4">
            <img class="h-10 w-10 rounded-full" src="{{ $comment->user->gravatar }}" alt="{{ $comment->user->name }}">
        </div>
        <div class="flex-grow group">
            <div>
                <a href="#" class="font-medium text-slate-800">{{ $comment->user->name }}</a>
            </div>
            <div class="mt-1 flex-grow w-full">
                @if ($isEditing)
                    <form wire:submit.prevent="editComment">
                        <div>
                            <x-textarea wire:model.defer="editState.body" id="comment" :label="trans('Comment')"
                                placeholder="Your comment" />
                        </div>
                        <div class="mt-3 flex items-center justify-end space-x-2">
                            <x-button xs squared negative wire:click="cancelEditComment" :label="trans('Cancel')" spinner />
                            <x-button xs squared positive wire:click="editComment" :label="trans('Edit')" spinner />
                        </div>
                    </form>
                @else
                    <p class="text-slate-700">{!! $comment->presenter()->markdownBody() !!}</p>
                @endif
            </div>
            <div class="mt-2 space-x-2 flex items-center align-middle">
                <div class="text-slate-500 font-medium text-xs">
                    {{ $comment->presenter()->relativeCreatedAt() }}
                </div>
                @auth
                    <div class="opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-500">
                        @if ($comment->hasParent())
                            <x-button icon="reply" xs squared flat slate wire:click="$toggle('isReplying')" />
                        @endif
                        @can('update', $comment)
                            <x-button icon="pencil-alt" xs squared flat slate wire:click="$toggle('isEditing')" />
                        @endcan
                        @can('destroy', $comment)
                            <x-button icon="trash" xs squared flat negative
                                wire:click.prevent="confirm({{ $comment->id }})" />
                        @endcan
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <div class="ml-14 mt-6">
        @if ($isReplying)
            <form wire:submit.prevent="postReply" class="my-4">
                <div>
                    <x-textarea wire:model.defer="replyState.body" id="comment" :label="trans('Reply')"
                        :placeholder="trans('Your comment')" />
                </div>
                <div class="mt-3 flex items-center justify-end">
                    <x-button xs :label="trans('Comment')" squared positive wire:click="postReply" />
                </div>
            </form>
        @endif
        @foreach ($comment->children as $child)
            <div class="bg-slate-50 px-4 pt-4 border-b border-slate-300">
                <livewire:comments.comment :comment="$child" :key="$child->id" />
            </div>
        @endforeach
    </div>
</div>
