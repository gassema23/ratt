<div>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-6 md:col-span-2 2xl:col-span-1">
            <div class="flex space-y-4 flex-col">
                <x-card>
                    <div class="text-xl font-bold mb-4">@lang('Files')</div>
                    @livewire('ratt.networks.attachments', ['model' => $documentation])
                </x-card>
                <x-card>
                    <div class="text-xl font-bold mb-4">@lang('Categories')</div>
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50">
                                ddd
                            </a>
                        </li>
                    </ul>
                </x-card>
                <x-card>
                    <div class="text-xl font-bold mb-4">@lang('Tags')</div>
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50">
                                ddd
                            </a>
                        </li>
                    </ul>
                </x-card>
            </div>
        </div>
        <div class=" col-span-6 md:col-span-4 2xl:col-span-5">
            <x-card>
                {{--  HEADER --}}
                <div>
                    <h2 class="text-3xl font-semibold text-slate-800 pb-4">
                        {{ $documentation->name }}
                    </h2>
                    <div class="flex justify-between pt-4">
                        <div
                            class="flex align-middle items-center space-x-2 font-semibold text-xs uppercase text-slate-600">
                            <div>
                                <x-avatar src="{{ $documentation->creator->gravatar }}" sm />
                            </div>
                            <div>
                                @lang('By :name', ['name' => $documentation->creator->name])
                            </div>
                            <x-icon name="clock" class="w-5 h-5 text-slate-500 ml-5 text-teal-500" />
                            <span>
                                {{ $documentation->created_at }}
                            </span>
                        </div>
                        <div class="flex align-middle items-center font-semibold text-xs uppercase text-slate-600">
                            <div class="bg-slate-50 px-2 py-1 border border-slate-200 flex align-middle items-center hover:bg-slate-100 cursor-pointer"
                                onclick='window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });'>
                                <x-icon name="annotation" class="w-5 h-5 text-slate-500 pr-1 text-teal-500" />
                                <span>{{ $documentation->comments->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  HEADER END --}}
                <div class="w-full">
                    {{-- Cat and tag --}}
                    <div
                        class="flex align-middle items-center font-semibold text-xs uppercase text-slate-600 my-4 border-b border-slate-200 pb-4 space-x-4">
                        <div>
                            <span class=" font-bold mr-2">@lang('Categories:')</span>
                            <x-badge squared teal :label="$documentation->category->name" />
                        </div>
                        <div>
                            <span class=" font-bold mr-2">@lang('Tags:')</span>
                            @foreach ($documentation->tags as $tag)
                                <x-badge squared slate :label="$tag->name" />
                            @endforeach
                        </div>
                    </div>
                    <div class="prose prose-slate max-w-none">
                        {!! $documentation->description !!}
                    </div>
                    <div>
                        <livewire:comments.comments :model="$documentation" :wire:key="'comments-'.$documentation->id" />
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
