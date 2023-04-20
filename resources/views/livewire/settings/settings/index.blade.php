<div>
    <x-card>
        <form wire:submit.prevent="save" class="w-full">
            <x-errors class="my-2 " />
            @foreach ($values as $key => $value)
                @if (is_array($value))
                    <div class="font-bold text-teal-500">{{ Str::of($key)->headline() }}</div>
                    @foreach ($value as $k => $v)
                        <div class="my-2 flex flex-col md:flex-row align-middle items-center w-full">
                            <label for="{{ Str::slug($k) }}" class="w-full md:w-1/6 mb-2 md:mb-0 font-medium">
                                {{ Str::of($k)->headline() }}
                            </label>
                            <div class="w-full md:w-5/6">
                                <x-input id="{{ Str::slug($k) }}" wire:model.defer="values.{{ $key }}.{{ $k }}" :value="$v" />
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="my-2 flex flex-col md:flex-row align-middle items-center w-full">
                        <label for="{{ Str::slug($key) }}" class="w-full md:w-1/6 mb-2 md:mb-0 font-medium">{{ Str::of($key)->headline() }}</label>
                        <div class="w-full md:w-5/6">
                            <x-input id="{{ Str::slug($key) }}" wire:model.defer="values.{{ $key }}" :value="$value" />
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="px-6 py-4 border-t border-neutral-200 bg-neutral-100 justify-end flex space-x-2">
                <x-button wire:keydown.enter="save" wire:click.prevent="save" squared positive spinner="save"
                    :label="__('Save')" />
            </div>
        </form>
    </x-card>
</div>
