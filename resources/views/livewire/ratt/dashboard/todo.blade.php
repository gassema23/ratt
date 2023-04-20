<div>
    <div class="font-medium text-2xl text-slate-800 mb-2">@lang('To do')</div>
    <x-card>
        @forelse ($todos as $todo)
            <div x-data="{ open: false }" x-id="['collapse']">
                <div class="font-bold mb-2 flex justify-between align-middle items-center">
                    <a href="#" class=" hover:underline" @click="open = !open;" :aria-controls="$id('collapse')"
                        :aria-expanded="open" @keydown.escape.prevent.stop="open = false">
                        {{ $todo->network_element . ' / ' . $todo->network_no . ' (' . $todo->networktasks->count() . ')' }}
                    </a>
                    <div x-cloak :class="open && 'rotate-180'"
                        class=" transform transition-transform duration-300 ease-linear">
                        <x-icon name="chevron-down" class="w-4 h-4" />
                    </div>
                </div>
                <div x-cloak x-show="open" x-collapse :id="$id('collapse')"
                    @keydown.escape.prevent.stop="open = false">
                    @foreach ($todo->networktasks as $networktask)
                        <div x-data="{ subopen: false }" x-id="['subcollapse']" class="pl-4">
                            <div class="font-medium mb-2 flex justify-between align-middle items-center">
                                <a href="#" class=" hover:underline" @click="subopen = !subopen;"
                                    :aria-controls="$id('subcollapse')" :aria-expanded="subopen"
                                    @keydown.escape.prevent.stop="subopen = false">
                                    {{ $networktask->task->name . ' (' . $networktask->checklists->count() . ')' }}
                                </a>
                                <div x-cloak :class="subopen && 'rotate-180'"
                                    class=" transform transition-transform duration-300 ease-linear">
                                    <x-icon name="chevron-down" class="w-4 h-4" />
                                </div>
                            </div>
                            <div x-cloak x-show="subopen" x-collapse :id="$id('subcollapse')"
                                @keydown.escape.prevent.stop="subopen = false">
                                @foreach ($networktask->checklists as $list)
                                    <div class="flex mb-4 items-center pl-4">
                                        <p
                                            class="w-full @if ($list->status > 0) line-through text-teal-500 @endif">
                                            {{ $list->name }}
                                        </p>
                                        @if ($list->status <= 0)
                                            <x-button squared xs teal icon="check"
                                                wire:click.prevent="check({{ $list->id }})"
                                                :wire:key="'check-'.$list->id" />
                                        @else
                                            <x-button squared xs slate icon="x"
                                                wire:click.prevent="uncheck({{ $list->id }})"
                                                :wire:key="'uncheck-'.$list->id" />
                                        @endif
                                        @can('checklists-delete')
                                            <x-button squared xs negative icon="trash" />
                                        @endcan
                                    </div>
                                @endforeach
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
