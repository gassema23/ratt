<div>
    <x-app-modal>
        <form wire:submit.prevent="save" autocomplete="off">
            <x-slot name="title">
                {{ __('Update :name', ['name' => $country->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-5 gap-4">
                    <x-input wire:model.defer="country.iso" required :label="trans('ISO')" :hint="trans('Field required')"
                        autocomplete="off" />
                    <div class="col-span-4 grid grid-cols-2 gap-4">
                        <x-input wire:model.defer="country.name.en" required :label="trans('Country [EN]')" :hint="trans('Field required')"
                            autocomplete="off" />
                        <x-input wire:model.defer="country.name.fr" :label="trans('Country [FR]')" autocomplete="off" />
                    </div>
                </div>
                <div class="my-2 grid grid-cols-3 gap-4">
                    <x-input wire:model.defer="country.region" :label="trans('Region')" autocomplete="off" />
                    <x-input wire:model.defer="country.sub_region" :label="trans('Sub Region')" autocomplete="off" />
                    <x-input wire:model.defer="country.capital" :label="trans('Capital')" autocomplete="off" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="country.latitude" :label="trans('Latitude')" autocomplete="off" />
                    <x-input wire:model.defer="country.longitude" :label="trans('Longitude')" autocomplete="off" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
