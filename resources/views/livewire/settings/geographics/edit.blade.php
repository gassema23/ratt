<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('Update :name', ['name' => $geographic_type->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="geographic_type.name.en" :label="trans('Type name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="geographic_type.name.fr" :label="trans('Type name [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
