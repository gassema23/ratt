<div>
    @if ($network->networktasks->count() <= 0)
        @can('networks-assignScenarios')
            <div @class(['mb-4'])>
                @lang('At this time, there are no scenarios associated. Please attempt to add one.')
            </div>
            <x-button squared slate :label="trans('Add scenario')"
                wire:click="$emit('openModal', 'ratt.networks.sections.assign-scenario',{{ json_encode([$network->id]) }})" />
        @endcan
    @else
        @can('networks-changeScenarios')
            <div class="my-2 pb-2 border-b border-slate-200 w-full flex items-center align-middle justify-between">
                <span class="font-bold uppercase text-lg">{{ $network->networktask->scenario->name }}</span>
                <x-button squared xs :label="trans('Change scenario')"
                    wire:click="$emit('openModal', 'ratt.networks.sections.change-scenario',{{ json_encode([$network->id]) }})" />
            </div>
        @endcan
        @livewire('ratt.networks.sections.task-section', [$network])
    @endif
</div>
