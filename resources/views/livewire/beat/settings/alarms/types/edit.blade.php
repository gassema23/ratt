<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('Update :name', ['name' => $alarm->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="grid my-2 gap-4 grid-cols-1">
                    <x-select wire:model.defer="alarm.alarm_category_id" :options="$categories" option-value="id"
                        autocomplete="off" option-label="label" :placeholder="__('Make a selection')" :label="__('Category')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="alarm.label.en" :label="trans('Type name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="alarm.label.fr" :label="trans('Type name [FR]')" />
                </div>

                <div class="grid grid-cols-2 gap-4 my-2">
                    <x-textarea wire:model.defer="alarm.description.en" :label="trans('Description [EN]')" />
                    <x-textarea wire:model.defer="alarm.description.fr" :label="trans('Description [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
