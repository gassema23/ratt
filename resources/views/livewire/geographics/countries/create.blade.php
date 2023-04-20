<div>
    <x-app-modal>
        <form wire:submit.prevent="save" autocomplete="off">
            <x-slot name="title">
                {{ trans('New country') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-5 gap-4">
                    <x-input wire:model.lazy="iso" required :label="trans('ISO')" :hint="trans('Field required')" autocomplete="off" />
                    <div class="col-span-4 grid grid-cols-2 gap-4">
                        <x-input wire:model.lazy="name.en" required :label="trans('Country [EN]')" :hint="trans('Field required')" autocomplete="off"/>
                        <x-input wire:model.lazy="name.fr" :label="trans('Country [FR]')" autocomplete="off" />
                    </div>
                </div>
                <div class="my-2 grid grid-cols-3 gap-4">
                    <x-input wire:model.defer="region" :label="trans('Region')" autocomplete="off" />
                    <x-input wire:model.defer="sub_region" :label="trans('Sub Region')" autocomplete="off" />
                    <x-input wire:model.defer="capital" :label="trans('Capital')" autocomplete="off" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="latitude" :label="trans('Latitude')" autocomplete="off" />
                    <x-input wire:model.defer="longitude" :label="trans('Longitude')" autocomplete="off" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
