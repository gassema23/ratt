<div>
    <x-card>
        <div class="flex justify-between">
            <nav class="mb-8 text-sm">
                <ol class="list-reset flex">
                    <li class="text-slate-500">
                        <a href="{{ route('admin.documentations.index') }}"
                            class="text-teal-500 transition duration-150 ease-in-out hover:underline focus:text-teal-700 active:text-teal-700">
                            @lang('Documentations')
                        </a>
                    </li>
                    <li>
                        <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                    </li>
                    <li class="text-slate-500">{{ $documentation->name }}</li>
                </ol>
            </nav>
            @can('edit-documentations')
                <div>
                    <x-button squared outline teal xs icon="pencil"
                        wire:click="$emit('openModal', 'documentations.documentations.edit', {{ json_encode([$documentation->id]) }})" />
                </div>
            @endcan
        </div>
        {{--  HEADER --}}
        <div class="">
            <h2 class="text-3xl font-semibold text-slate-800 pb-1">{{ $documentation->name }}</h2>
            <div class="flex">
                <div class="flex align-middle items-center space-x-3 font-normal text-xs uppercase text-slate-400">
                    <div class="flex align-middle items-center space-x-1">
                        <x-icon name="user" class="w-4 h-4" />
                        <span>@lang('By :name', ['name' => $documentation->creator->name])</span>
                    </div>
                    <div class="flex align-middle items-center space-x-1">
                        <x-icon name="clock" class="w-4 h-4" />
                        <span>{{ $documentation->created_at->isoFormat('LLLL') }}</span>
                    </div>
                    <div class="flex align-middle items-center space-x-1">
                        <x-icon name="folder" class="w-4 h-4" />
                        <span>{{ $documentation->category->name }}</span>
                    </div>
                    <div class="flex space-x-1 align-middle items-center">
                        @foreach ($documentation->tags as $tag)
                            <div class="flex align-middle items-center">
                                <x-icon name="hashtag" class="w-4 h-4" />
                                <span>{{ $tag->name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex align-middle items-center space-x-1">
                        <x-icon name="annotation" class="w-4 h-4" />
                        <span>
                            @choice('[0,1]:n comment|[2,*]:n comments', $documentation->comments->count(), [
                                'n' => $documentation->comments->count(),
                            ])
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-8 h-px border-0 bg-slate-300" />
        {{--  HEADER END --}}
        <div class="w-full">
            {{-- Cat and tag --}}
            <div class="prose prose-slate max-w-none">
                {!! $documentation->description !!}
            </div>
            <div>
                <livewire:comments.comments :model="$documentation" :wire:key="'comments-'.$documentation->id" />
            </div>
        </div>
    </x-card>
</div>
