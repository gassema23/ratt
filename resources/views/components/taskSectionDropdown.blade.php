@if (is_null($data->is_completed) ||
        auth()->user()->hasAnyDirectPermission(['networks-markAsCompleted', 'networks-changeStatusTasks', 'tasks-update']) ||
        auth()->user()->is_planner)
    <x-dropdown align="right">
        <x-dropdown.header :label="trans('Manage tasks')">
            <x-slot name="trigger">
                <x-icon name="dots-horizontal" class="w-4 h-4" />
            </x-slot>
            @if (auth()->user()->can('networks-markAsCompleted') || auth()->user()->is_planner)
                @if ($data->complete_link)
                    <x-dropdown.item href="#" :label="trans('Mark as completed')" wire:click="markAsCompleted({{ $data->id }})" />
                @endif
            @endcan
            @if (is_null($data->is_completed))
                @if ($data->status != 4)
                    @if (auth()->user()->is_planner ||
                            auth()->user()->can('networks-changeStatusTasks'))
                        <x-dropdown.item href="#" :label="trans('Change status')"
                            onclick="Livewire.emit('openModal', 'ratt.networks.sections.change-status-tasks', {{ json_encode([$data->id]) }})" />
                    @endif
                @endif
                @can('tasks-update')
                    <x-dropdown.item href="#" :label="trans('Edit task')"
                        onclick="Livewire.emit('openModal', 'ratt.networks.sections.task-edit', {{ json_encode([$data->id]) }})" />
                @endcan
            @endif
    </x-dropdown.header>
</x-dropdown>
@else
@hasanyrole(['Super-Admin', 'Admin'])
    <x-button squared xs negative outline :label="trans('Roll back status')"
    wire:click="rollback({{ $data->id }})" />
@endhasanyrole
@endif
