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
                    <h2 class="title-font font-semibold text-gray-800 tracking-wider text-sm ">@lang('Abilities')</h2>
                    <ul class="flex flex-wrap list-none -mb-1">
                        @foreach ($permissions as $permission)
                            <li class="lg:w-1/2 mb-1 w-1/3">
                                <x-checkbox id="{{ $permission->id }}" :label="$permission->name" value="{{ $permission->id }}"
                                    wire:model.defer="permission_id.{{ $permission->id }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
