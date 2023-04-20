<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Select Status') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2" />
                <div class="my-2">
                    <x-select wire:model.defer="status" :options="config('biri.App_statuses.'.App::getLocale())" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Status')" />
                </div>
                <div class="my-2">
                    <x-textarea wire:model.defer="reason" :label="trans('Reason')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
