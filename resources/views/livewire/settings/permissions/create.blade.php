<div>
    <x-app-modal>
        <form wire:submit.prevent="save" wire:keydown.enter="save">
            <x-slot name="title">
                {{ __('Create new permission') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2">
                    <x-input wire:model.defer="name" :label="__('Permission name')" :hint="trans('Field required')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" wire:keydown.enter="save" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
