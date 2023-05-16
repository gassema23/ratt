<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Change scenario') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2" />
                <div class="flex w-full text-sm space-x-4 border-b border-slate-200 pb-4 mb-4">
                    <div>@lang('Network started at :date', ['date' => $network->started_at->toFormattedDayDateString()])</div>
                    <div>@lang('Network ended at :date', ['date' => $network->ended_at->toFormattedDayDateString()])</div>
                </div>
                <div class="rounded-lg bg-warning-50 p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-warning-400 shrink-0 mr-3" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-warning-800 dark:text-warning-600">
                            @lang('This change will delete all data associated with the old scenario')
                        </span>
                    </div>
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
                                                        <x-checkbox id="task-{{ $task->id }}" :label="$task->name"
                                                            wire:model.defer="inputs.{{ $task->id }}.task"
                                                            value="{{ $task->id }}" />
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
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')"
                    x-on:confirm="{
                    title: 'Sure Delete?',
                    icon: 'warning',
                    method: 'save'
                }" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
