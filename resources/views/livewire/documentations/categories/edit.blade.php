<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update :name', ['name' => $category->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="category.name.en" :label="__('Category [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="category.name.fr" :label="__('Category [FR]')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-textarea wire:model.defer="category.description.en" :label="trans('Description [EN]')" />
                    <x-textarea wire:model.defer="category.description.fr" :label="trans('Description [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
