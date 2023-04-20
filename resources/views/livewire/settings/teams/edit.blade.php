<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update team') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2">
                    <x-select wire:model.defer="team.owner_id" :options="$users" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Team owner')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="team.name.en" :label="__('Team name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="team.name.fr" :label="__('Team name [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
