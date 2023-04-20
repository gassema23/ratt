<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('Update :name', ['name' => $technology->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="technology.name.en" :label="trans('Technology name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="technology.name.fr" :label="trans('Technology name [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
