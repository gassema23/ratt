<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update :name :description', [
                    'name' => $biri_activity->activity_name,
                    'description' => $biri_activity->activity_description,
                ]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model.defer="biri_activity.technology_name" :options="$technologies"
                        option-value="technology_name" autocomplete="off" option-label="technology_name" :placeholder="__('Make a selection')"
                        :label="__('Technology')" :hint="trans('Field required')" />
                    <x-select wire:model.defer="biri_activity.equipment_name" :options="$equipments"
                        option-value="equipment_name" autocomplete="off" option-label="equipment_name" :placeholder="__('Make a selection')"
                        :label="__('Equipment')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model.defer="biri_activity.activity_name" :options="$activities"
                        option-value="activity_name" autocomplete="off" option-label="activity_name" :placeholder="__('Make a selection')"
                        :label="__('Activity')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="biri_activity.activity_description" :label="__('Description')"
                        :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-4 gap-4">
                    <x-inputs.number wire:model.defer="biri_activity.average" :label="__('Average')" />
                    <x-inputs.number wire:model.defer="biri_activity.average_actual" :label="__('Actual average')" />
                    <x-inputs.number wire:model.defer="biri_activity.ps50_plan" :label="__('PS50 plan')" />
                    <x-inputs.number wire:model.defer="biri_activity.ps50_activity" :label="__('PS50 activity')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
