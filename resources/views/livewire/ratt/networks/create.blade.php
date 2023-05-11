<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('New network') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="flex w-full text-sm space-x-4 border-b border-slate-200 pb-4 mb-4">
                    <div>@lang('Project started at') <strong>{{ $project->started_at->toFormattedDayDateString() }}</strong></div>
                    <div>@lang('Project ended at') <strong>{{ $project->ended_at->toFormattedDayDateString() }}</strong></div>
                </div>
                <div class="my-2 grid grid-cols-2 gap-2">
                    <x-input wire:model.defer="network_no" :label="__('Network number')" :hint="trans('Field required (1234567)')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-2">
                    <x-select wire:loading.attr="disabled" wire:model="site_id" :options="$sites" option-value="id"
                        option-label="clli" option-description="name" autocomplete="off" :placeholder="__('Make a selection')"
                        :label="__('Site')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="network_element" :label="__('Network element')" :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-datetime-picker :label="__('Started date')" wire:model.defer="started_at" without-time :hint="trans('Field required')" />
                    <x-datetime-picker :label="__('Ended date')" wire:model.defer="ended_at" without-time :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-2 gap-2 my-2">
                    <x-input wire:model.defer="name" :label="__('Network name')" :hint="trans('Field required')" />
                </div>
                <div class="grid grid-cols-1 gap-2 my-2">
                    <livewire:trix>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
