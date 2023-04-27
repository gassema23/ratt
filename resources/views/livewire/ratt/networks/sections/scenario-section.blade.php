<div>
    @if ($network->networktasks->count() <= 0)
        <div @class(['mb-4'])>
            @lang('At this time, there are no scenarios associated. Please attempt to add one.')
        </div>
        <x-button squared slate :label="trans('Add scenario')"
            wire:click="$emit('openModal', 'ratt.networks.sections.assign-scenario',{{ json_encode([$network->id]) }})" />
    @else
        @livewire('ratt.networks.sections.task-section', [$network])
    @endif
</div>
