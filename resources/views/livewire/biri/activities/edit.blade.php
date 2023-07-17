<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                @if ($isUpdated)
                    {{ __('Update :name', ['name' => $activity->name]) }}
                @else
                    {{ __('New activity') }}
                @endif
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="activity.description.en" :label="__('Activity [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="activity.description.fr" :label="__('Activity [FR]')" />
                </div>
                <div class="my-2 grid grid-cols-3 gap-4">
                    <x-select wire:model.defer="activity.technology_id" :options="$technologies" option-value="id"
                        autocomplete="off" option-label="label" :placeholder="__('Make a selection')" :label="__('Technology')" />
                    <x-select wire:model.defer="activity.equipment_id" :options="$equipments" option-value="id"
                        autocomplete="off" option-label="label" :placeholder="__('Make a selection')" :label="__('Equipment')" />
                    <x-select wire:model.defer="activity.category_id" :options="$categories" option-value="id"
                        autocomplete="off" option-label="label" :placeholder="__('Make a selection')" :label="__('Category')" />
                </div>
                <div class="my-2 grid grid-cols-4 gap-4">
                    <x-input wire:model.defer="activity.avg_single" :label="__('Avg single')" />
                    <x-input wire:model.defer="activity.ps50_plan" :label="__('PS50 plan')" />
                    <x-input wire:model.defer="activity.ps50_act" :label="__('PS50 activity')" />
                    <x-input wire:model.defer="activity.avg_actual" :label="__('Avg. actual')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
