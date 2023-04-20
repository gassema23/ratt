<div>
    @if ($tasks->count() <= 0)
    <div class="flex justify-end w-full pb-4 align-middle content-center items-center">
        @can('tasks-create')
            <a href="#" class="text-teal-500 hover:underline uppercase text-xs"
                wire:click="$emit('openModal', 'ratt.networks.sections.assign-scenario',{{ json_encode([$network->id]) }})">
                <x-icon name="plus" class="w-4 h-4 inline-block" /> @lang('Assign scenario')
            </a>
        @endcan
    </div>
    @endif
    @if ($tasks->count() > 0)
        <x-card class="w-full">
            <div class="flex justify-end w-full px-4 py-2 -mb-px" wire:loading>
                <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
            <div wire:loading.remove>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class=" divide-y divide-slate-200">
                        @foreach ($tasks->groupBy('team.name') as $k_task => $v_task)
                            <div class="font-medium py-4 text-lg">{{ $k_task }}</div>
                            @foreach ($v_task as $task)
                                <div class="flex justify-between items-center space-x-4 py-4">
                                    <div class="w-1/3 text-sm flex-1 flex flex-row items-center">
                                        <div class="mr-2">
                                            <x-button squared flat icon="eye"
                                                wire:click="taskInfo({{ $task->id }})" />
                                        </div>
                                        <div class="font-medium truncate">
                                            {{ $task->task->name }}
                                        </div>
                                    </div>
                                    <div class="flex text-left text-slate-400 space-x-2 items-center align-middle">
                                        <div class="ml-2">
                                            @if ($task->status)
                                                <x-badge :label="$task->status_name" squared :color="$task->status_color" />
                                            @else
                                                <x-badge :label="trans('New')" squared slate />
                                            @endif
                                        </div>
                                        <div class=" text-slate-400">
                                            <x-icon name="chat-alt-2" class="w-5 h-5 inline-block" />
                                            {{ $task->comments_count }}
                                        </div>
                                        <div class=" text-slate-400">
                                            <x-icon name="clipboard-list" class="w-5 h-5 inline-block" />
                                            {{ $task->complete_checklists_count }}/{{ $task->checklists_count }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        {{ $tasks->links() }}
                    </div>
                    <div class="flex justify-end w-full px-2 py-2 -mb-px" wire:loading>
                        <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                    @if (!is_null($taskInfoSection))
                        <div wire:loading.remove>
                            <div class="flex justify-between text-slate-500 border-b border-slate-200 text-xs py-4">
                                <div class="px-2 font-medium ">
                                    @if (auth()->user()->id === $taskInfoSection->network->project->planner_id ||
                                            auth()->user()->id === $taskInfoSection->network->project->prime_id ||
                                            auth()->user()->hasRole('Super-Admin'))
                                        @if (
                                            $taskInfoSection->complete_checklists_count === $taskInfoSection->checklists_count &&
                                                $taskInfoSection->checklists_count > 0)
                                            @if (is_null($taskInfoSection->is_complete) &&
                                                    auth()->user()->hasRole(['Super-Admin', 'Admin']))
                                                @if ($taskInfoSection->status == 4)
                                                    <x-button :label="trans('Mark as complete')" sm squared flat />
                                                @endif
                                            @else
                                                <x-badge :label="trans('Complete')" squared color="teal" />
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="px-2">
                                    <x-dropdown align="right">
                                        <x-dropdown.header :label="trans('Manage taks')">
                                            <x-slot name="trigger">
                                                <x-icon name="dots-horizontal" class="w-4 h-4" />
                                            </x-slot>
                                            <x-dropdown.item href="#" :label="trans('Activities')"
                                                onclick="Livewire.emit('openModal', 'ratt.networks.sections.history-tasks', {{ json_encode([$taskInfoSection->id]) }})" />
                                            @if ($taskInfoSection->status != 4)
                                                <x-dropdown.item href="#" :label="trans('Change status')"
                                                    onclick="Livewire.emit('openModal', 'ratt.networks.sections.change-status-tasks', {{ json_encode([$taskInfoSection->id]) }})" />
                                            @endif
                                        </x-dropdown.header>
                                    </x-dropdown>
                                </div>
                            </div>
                            <div class="flex justify-between p-4">
                                <div>
                                    <h3 class="text-lg font-medium text-slate-900">
                                        {{ $taskInfoSection->task->name }}
                                    </h3>
                                </div>
                                <div>
                                    @if ($taskInfoSection->status)
                                        <x-badge :label="$taskInfoSection->status_name" squared :color="$taskInfoSection->status_color" />
                                    @else
                                        <x-badge :label="trans('New')" squared slate />
                                    @endif
                                    <x-badge :label="$taskInfoSection->badgepriorityname" squared :color="$taskInfoSection->badgeprioritycolor" />
                                </div>
                            </div>
                            <div class="flex justify-between p-4 text-slate-400">
                                <div class="grid grid-cols-1">
                                    <div class="font-medium pb-2 text-slate-600">@lang('Assign to')</div>
                                    <div class="text-sm">{{ $taskInfoSection->team->name }}</div>
                                </div>
                                <div class="grid grid-cols-1">
                                    <div class="font-medium pb-2 text-slate-600">@lang('Due to')</div>
                                    <div class="text-sm ">
                                        <x-icon name="calendar" class="w-4 h-4 inline-block mr-1" />
                                        {{ $taskInfoSection->due_date }}
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1">
                                <div>
                                    <livewire:ratt.checklists.checklist :model="$taskInfoSection"
                                        :wire:key="'checklists-'.$taskInfoSection->id" />
                                </div>
                            </div>
                            @can('attachments-view')
                                <div class="grid grid-cols-1 p-4 divide-y divide-slate-200">
                                    <div class="font-bold flex justify-between items-center align-middle">
                                        @lang('Attachments')
                                        @can('attachments-create')
                                            <x-button :label="trans('Add files')" flat slate squared xs
                                                onclick="Livewire.emit('openModal', 'ratt.networks.attach-files', {{ json_encode(['model_id' => $taskInfoSection->id, 'model' => App\Models\NetworkTask::class]) }})" />
                                        @endcan
                                    </div>
                                    <div class="pt-4">
                                        <livewire:ratt.networks.attachments :model="$taskInfoSection" />
                                    </div>
                                </div>
                            @endcan
                            @can('comments-view')
                                <div class="grid grid-cols-1">
                                    <livewire:comments.comments :model="$taskInfoSection"
                                        :wire:key="'comments-'.$taskInfoSection->id" />
                                </div>
                            @endcan
                        </div>
                    @endif
                </div>
            </div>
        </x-card>
    @else
        <x-empty-data :name="trans('tasks')" />
    @endif
</div>
