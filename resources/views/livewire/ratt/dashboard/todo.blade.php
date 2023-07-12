<div>
    <div class="font-medium text-2xl text-slate-800 mb-2">@lang('To do')</div>
    <x-card>
        @forelse ($networks as $network)
            <div x-data="{ open: false }" x-id="['collapse']">
                <div class="font-bold mb-2 flex justify-between align-middle items-center">
                    <a href="#" class=" hover:underline" @click="open = !open;" :aria-controls="$id('collapse')"
                        :aria-expanded="open" @keydown.escape.prevent.stop="open = false">
                        {{ $network->network_element_lists.' / '.$network->network_no . ' (' . $network->networktasks->count() . ')' }}
                    </a>
                    <div x-cloak :class="open && 'rotate-180'"
                        class=" transform transition-transform duration-300 ease-linear">
                        <x-icon name="chevron-down" class="w-4 h-4" />
                    </div>
                </div>
                <div x-cloak x-show="open" x-collapse :id="$id('collapse')"
                    @keydown.escape.prevent.stop="open = false">
                    @foreach ($network->networktasks as $networktask)
                        <div class="flex justify-between items-center space-x-4 py-2 divide-y divide-slate-100">
                            <div class="w-1/3 text-sm flex-1 flex flex-row items-center">
                                <div class="font-medium truncate">
                                    <a href="{{ route('admin.ratt.networks.show.params', [
                                        'id' => $network->id,
                                        'parameter' => 'scenarios',
                                    ]) }}"
                                        class=" hover:underline">
                                        {{ $networktask->task->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex text-left text-slate-400 space-x-2 items-center align-middle">
                                <div class="ml-2">
                                    <x-badge :label="$networktask->status_name" squared :color="$networktask->status_color" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div>
                @lang('No task to show...')
            </div>
        @endforelse
    </x-card>
</div>
