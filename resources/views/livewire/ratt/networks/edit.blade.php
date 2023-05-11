<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update network') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="flex w-full text-sm space-x-4 border-b border-slate-200 pb-4 mb-4">
                    <div>@lang('Project started at :date', ['date' => $network->project->started_at->toFormattedDayDateString()])</div>
                    <div>@lang('Project ended at :date', ['date' => $network->project->ended_at->toFormattedDayDateString()])</div>
                </div>
                <div class="my-2 grid grid-cols-2 gap-2">
                    <x-select wire:model="site_id" :options="$sites" option-value="id" autocomplete="off"
                        option-label="clli" option-description="name" :placeholder="__('Make a selection')" :label="__('Clli')"
                        :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-2">
                    <x-input wire:model.defer="network.network_no" :label="__('Network number')" :hint="trans('Field required (1234567)')" />
                    <x-input wire:model.defer="network_element" :label="__('Network element')" :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-datetime-picker :label="__('Started date')" wire:model.defer="network.started_at" without-time
                        :hint="trans('Field required')" />
                    <x-datetime-picker :label="__('Ended date')" wire:model.defer="network.ended_at" without-time
                        :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-input wire:model.defer="network.name" :label="__('Network name')" :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-1 gap-2 my-2">
                    <livewire:trix :value="$network->description">
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
