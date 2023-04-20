<section>
    <div class="bg-white sm:overflow-hidden p-4">
        <div class="divide-y divide-slate-200">
            <div class="pb-4">
                <h2 class="text-lg font-medium text-slate-900">@lang('Comments')</h2>
            </div>
            <div class="pt-4">
                <div class="space-y-8">
                    @if ($comments->isNotEmpty())
                        @foreach ($comments as $comment)
                            <livewire:comments.comment :comment="$comment" :key="$comment->id" />
                        @endforeach
                        {{ $comments->links() }}
                    @else
                        <p class="inline-flex items-center gap-x-2 py-1.5 font-medium text-slate-400">
                            @lang('No comments yet.')
                        </p>
                    @endif
                </div>
            </div>
        </div>
        @can('comments-create')
            <div class="bg-slate-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0 mr-4">
                        <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->gravatar }}"
                            alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="min-w-0 flex-1">
                        <form wire:submit.prevent="postComment">
                            <div>
                                <x-textarea wire:model.defer="newCommentState.body" id="comment" :label="trans('Comment')"
                                    :placeholder="trans('Your comment')" />
                            </div>
                            <div class="mt-3 flex items-center justify-end">
                                <x-button xs squared positive wire:click="postComment" :label="trans('Comment')" spinner />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</section>
