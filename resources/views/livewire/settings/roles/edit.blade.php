<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update :name', ['name' => $role->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2">
                    <x-input wire:model.defer="name" :label="__('Role name')" :hint="trans('Field required')" />
                </div>
                <div class="my-2">
                    <h2 class="title-font font-semibold text-slate-800 tracking-wider text-sm ">@lang('Abilities')</h2>
                    @foreach ($permissions as $permissionName => $permissionItems)
                        <div x-data="{ open: false }" class="my-4">
                            <button
                                class="flex items-center justify-between w-full px-4 py-2 font-medium text-left bg-slate-100 hover:bg-slate-200 focus:outline-none focus:ring focus:ring-teal-300"
                                x-on:click="open = !open">
                                <span>{{ ucfirst($permissionName) }}</span>
                                <span>
                                    <x-icon name="chevron-down" class="w-5 h-5" />
                                </span>
                            </button>
                            @foreach ($permissionItems as $permission)
                                <div class="px-4 py-2 text-slate-700" x-show="open" x-collapse>
                                    <x-checkbox id="{{ $permission['id'] }}" :label="$permission['name']"
                                        value="{{ $permission['id'] }}"
                                        wire:model.defer="permission_id.{{ $permission['id'] }}" />
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
