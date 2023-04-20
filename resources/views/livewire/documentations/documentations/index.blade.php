<div>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-6 md:col-span-2 2xl:col-span-1">
            <div class="flex space-y-4 flex-col">
                <x-card>
                    <div class="text-xl font-bold mb-4">@lang('Categories')</div>
                    <ul class="space-y-2">
                        @forelse($categories as $category)
                            <li>
                                <a href="#"
                                    class="font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                                    {{ $category->name }}
                                    <span
                                        class="text-right font-normal text-sm text-slate-500">({{ $category->documentations_count }})</span>
                                </a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </x-card>
                <x-card>
                    <div class="text-xl font-bold mb-4">@lang('Tags')</div>
                    <ul class="space-y-2">
                        @forelse($tags as $tag)
                            <li>
                                <button onclick="Livewire.emit('tagFilter', {{ json_encode($tag->name) }})"
                                    class="@if (empty($tag_name))
                                        @if (\Request::query('t') === $tag->name)
                                            text-teal-600 bg-teal-50
                                        @endif
                                    @elseif($tag_name === $tag->name)
                                        text-teal-600 bg-teal-50
                                    @endif font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                                    {{ $tag->name }}
                                    <span
                                        class="text-right font-normal text-sm text-slate-500">({{ $tag->count }})</span>
                                </button>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </x-card>
            </div>
        </div>
        <div class=" col-span-6 md:col-span-4 2xl:col-span-5">
            <x-card>
                @livewire('documentations.documentations.table')
            </x-card>
        </div>
    </div>
</div>
