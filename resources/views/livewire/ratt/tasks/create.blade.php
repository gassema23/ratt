<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('New task') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model="parent_id" :options="$parents" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Dependency')"/>
                    <x-select wire:model="team_id" :options="$teams" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Team')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="name.en" :label="trans('Task name [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="name.fr" :label="trans('Task name [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
