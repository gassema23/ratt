<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update :name', ['name' => $site->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-4 gap-4">
                    <x-select :label="__('Country')" :placeholder="__('Make a selection')" :options="$countries" option-label="name" option-value="id"
                        wire:model="country_id" :hint="trans('Field required')" />
                    <x-loading>
                        <x-select wire:loading.attr="disabled" wire:model="state_id" :options="$states" option-value="id"
                            option-label="name" autocomplete="off" :placeholder="__('Make a selection')" :label="__('State')"
                            :hint="trans('Field required')" />
                    </x-loading>
                    <x-loading>
                        <x-select wire:loading.attr="disabled" wire:model="region_id" :options="$regions"
                            option-value="id" option-label="name" autocomplete="off" :placeholder="__('Make a selection')"
                            :label="__('Region')" :hint="trans('Field required')" />
                    </x-loading>
                    <x-loading>
                        <x-select wire:loading.attr="disabled" wire:model.defer="city_id" :options="$cities"
                            option-value="id" option-label="name" autocomplete="off" :placeholder="__('Make a selection')"
                            :label="__('City')" :hint="trans('Field required')" />
                    </x-loading>
                </div>
                <div class="my-2 grid grid-cols-4 gap-4">
                    <x-input wire:model.defer="site.clli" :label="__('CLLI')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="site.address" :label="__('Address')" />
                    <x-input wire:model.defer="site.latitude" :label="trans('Latitude')" />
                    <x-input wire:model.defer="site.longitude" :label="trans('Longitude')" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="site.name.en" :label="__('Site [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="site.name.fr" :label="__('Site [FR]')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-inputs.phone wire:model.defer="site.phone_line" :label="__('Phone line')" />
                    <x-inputs.phone wire:model.defer="site.emergency_line" :label="__('Emergency line')" />
                </div>
                <div class="grid grid-cols-3 gap-2 my-2">
                    <x-input wire:model.defer="site.manager" :label="__('Manager')" />
                    <x-input wire:model.defer="site.plant" :label="__('Plant')" />
                    <x-select wire:loading.attr="disabled" wire:model.defer="site.type_id" :options="$types"
                        option-value="id" option-label="name" option-description="parent_name" autocomplete="off"
                        :placeholder="__('Make a selection')" :label="__('Type')" :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-textarea wire:model.defer="site.contact_and_site_access.en" :label="trans('Contact and site access [EN]')" />
                    <x-textarea wire:model.defer="site.contact_and_site_access.fr" :label="trans('Contact and site access [FR]')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-textarea wire:model.defer="site.other_site_information.en" :label="trans('Other site information [EN]')" />
                    <x-textarea wire:model.defer="site.other_site_information.fr" :label="trans('Other site information [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
