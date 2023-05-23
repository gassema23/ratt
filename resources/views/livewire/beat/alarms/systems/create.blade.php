<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('New alarm system') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-3 gap-4">
                    <x-select wire:loading.attr="disabled" wire:model="site_id" :options="$sites" option-value="id"
                        option-label="clli" option-description="name" autocomplete="off" :placeholder="__('Make a selection')"
                        :label="__('Site')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="network_element" :label="trans('Network element')" />
                    <x-input wire:model.defer="location_number" :label="trans('Location number')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:loading.attr="disabled" wire:model.defer="alarm_system_type_id" :options="$types"
                        option-value="id" option-label="label" autocomplete="off" :placeholder="__('Make a selection')" :label="__('System type')"
                        :hint="trans('Field required')" />

                    <x-input wire:model.defer="ipv4" :label="trans('IPV4')" />
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
