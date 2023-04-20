<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('New region') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select :label="__('Country')" :placeholder="__('Make a selection')" :options="$countries" option-label="name" option-value="id"
                        wire:model="country_id" :hint="trans('Field required')" />
                    <x-loading>
                        <x-select wire:loading.attr="disabled" wire:model.defer="state_id" :options="$states"
                            option-value="id" option-label="name" autocomplete="off" :placeholder="__('Make a selection')" :label="__('State')"
                            :hint="trans('Field required')" />
                    </x-loading>
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <div class="col-span-4 grid grid-cols-2 gap-4">
                        <x-input wire:model.defer="name.en" :label="__('Region name [EN]')" :hint="trans('Field required')" />
                        <x-input wire:model.defer="name.fr" :label="__('Region name [FR]')" />
                    </div>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
