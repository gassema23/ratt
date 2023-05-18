<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('New alarm status') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="label.en" :label="trans('Status name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="label.fr" :label="trans('Status name [FR]')" />
                </div>

                <div class="grid grid-cols-2 gap-4 my-2">
                    <x-textarea wire:model.defer="description.en" :label="trans('Description [EN]')" />
                    <x-textarea wire:model.defer="description.fr" :label="trans('Description [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
