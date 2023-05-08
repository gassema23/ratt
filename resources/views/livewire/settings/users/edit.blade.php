<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update :name',['name'=>$user->namep]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 flex space-x-4">
                    <x-checkbox id="desn" :label="trans('DESN')" wire:model.defer="user.desn" />
                    <x-checkbox id="tech_biri" :label="trans('Technicien')" wire:model.defer="user.tech_biri" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="user.name" :label="__('Full name')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="user.employe_id" :label="__('Employe ID')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="user.email" :label="__('Email')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="user.phone" :label="__('Phone')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model.defer="role_id" :options="$roles" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Roles')" :hint="trans('Field required')" />
                    <x-select wire:model.defer="team_id" :options="$teams" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Teams')" :hint="trans('Field required')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
