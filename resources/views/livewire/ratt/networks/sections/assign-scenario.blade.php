<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Assign scenario') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2" />
                <div class="flex w-full text-sm space-x-4 border-b border-slate-200 pb-4 mb-4">
                    <div>@lang('Network started at :date', ['date' => $network->started_at->toFormattedDayDateString()])</div>
                    <div>@lang('Network ended at :date', ['date' => $network->ended_at->toFormattedDayDateString()])</div>
                </div>
                <div class="grid grid-cols-1 gap-4 my-2">
                    <x-select wire:model="scenario_id" :options="$scenarios" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Scenario')" />
                </div>
                <div class="my-2">
                    <div wire:loading>
                        @lang('Loading data...')
                    </div>
                    @if ($scenariosData)
                        @foreach ($scenariosData as $scenario)
                            @foreach ($scenario->tasks->groupBy('team.name') as $k => $v)
                                <div wire:loading.remove class="my-4">
                                    <div class="font-medium">{{ $k }}</div>
                                    <table class="min-w-full text-left text-sm">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                            <tr>
                                                <th scope="col" class="px-6 py-4">
                                                    @lang('Task')
                                                </th>
                                                <th scope="col" class="px-6 py-4">
                                                    @lang('Due date')
                                                </th>
                                                <th scope="col" class="px-6 py-4">
                                                    @lang('Priorities')
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($v as $key => $task)
                                                <tr class="border-b dark:border-neutral-500"
                                                    wire:key="field-{{ $task->id }}">
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium truncate">
                                                        <div class="flex justify-between">
                                                            <x-checkbox id="task-{{ $task->id }}" :label="$task->name"
                                                                wire:model.defer="inputs.{{ $task->id }}.task"
                                                                value="{{ $task->id }}" />

                                                            @if (!is_null($task->parent))
                                                                <x-badge xs squared info :label="trans('This task relies on: :dependency.', ['dependency' => $task->parent->name])" />
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <x-input type="date"
                                                            wire:model.defer="inputs.{{ $task->id }}.duedate" />
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <x-native-select :placeholder="__('Make a selection')" :options="config('biri.App_priority.' . App::getLocale())"
                                                            wire:model.defer="inputs.{{ $task->id }}.priority"
                                                            option-value="id" option-label="name" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
