<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('Update :name', ['name' => $alarm->label]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="alarm.label.en" :label="trans('Generator type name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="alarm.label.fr" :label="trans('Generator type name [FR]')" />
                </div>
                <div class="grid grid-cols-2 gap-4 my-2">
                    <x-textarea wire:model.defer="alarm.prerequiste.en" :label="trans('Prerequiste [EN]')" />
                    <x-textarea wire:model.defer="alarm.prerequiste.fr" :label="trans('Prerequiste [FR]')" />
                </div>
                <div class="grid grid-cols-2 gap-4 my-2">
                    <x-textarea wire:model.defer="alarm.deployment_procedure.en" :label="trans('Deployment procedure [EN]')" />
                    <x-textarea wire:model.defer="alarm.deployment_procedure.fr" :label="trans('Deployment procedure [FR]')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="alarm.emergency_contact.en" :label="trans('Emergency contact [EN]')" />
                    <x-input wire:model.defer="alarm.emergency_contact.fr" :label="trans('Emergency contact [FR]')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="alarm.generator_available.en" :label="trans('Generator available [EN]')" />
                    <x-input wire:model.defer="alarm.generator_available.fr" :label="trans('Generator available [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
