<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Create new project') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="grid grid-cols-2 gap-4 my-2">
                    <x-select wire:model.defer="prime_id" :options="$primes" option-value="id" autocomplete="off"
                        option-label="name" option-description="employe_id" :placeholder="__('Make a selection')" :label="__('Project manager')" :hint="trans('Field required')" />
                    <x-select wire:model.defer="planner_id" :options="$planners" option-value="id" autocomplete="off"
                        option-label="name" option-description="employe_id" :placeholder="__('Make a selection')" :label="__('Planner')" :hint="trans('Field required')" />
                </div>
                <div class="my-2">
                    <x-input wire:model.defer="project_no" :label="__('Project number')" :hint="trans('Field required (P-1234567.01)')" />
                </div>
                <div class="grid grid-cols-2 gap-4 my-2">
                    <x-datetime-picker :label="__('Started date')" wire:model.defer="started_at" without-time :hint="trans('Field required')" />
                    <x-datetime-picker :label="__('Ended date')" wire:model.defer="ended_at" without-time :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-1 gap-4 my-2">
                    <x-input wire:model.defer="name" :label="__('Project name')" :hint="trans('Field required')" />
                </div>

                <div class="grid grid-cols-1 gap-4 my-2">
                    <livewire:trix>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
