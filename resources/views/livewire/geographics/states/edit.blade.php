<div>
    <x-app-modal>
        <form wire:submit.prevent="save" autocomplete="off">
            <x-slot name="title">
                {{ __('Update :name', ['name' => $state->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select :label="trans('Country')" wire:model="state.country_id" :placeholder="trans('Make a selection')" :options="$countries"
                        option-label="name" option-value="id" :hint="trans('Field required')" autocomplete="off" />
                    <x-select :label="trans('Type')" wire:model="state.type_id" :placeholder="trans('Make a selection')" :options="$types"
                        option-label="name" option-value="id" :hint="trans('Field required')" autocomplete="off" />
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <x-input wire:model.defer="state.abbr" :label="__('Abbr')" :hint="trans('Field required') autocomplete="off" />
                    <x-input wire:model.defer="state.name.en" :label="__('State name [EN]')" :hint="trans('Field required')" autocomplete="off" />
                    <x-input wire:model.defer="state.name.fr" :label="__('State name [FR]')" autocomplete="off" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="state.latitude" :label="__('Latitude')" autocomplete="off" />
                    <x-input wire:model.defer="state.longitude" :label="__('Longitude')" autocomplete="off" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
