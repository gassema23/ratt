<div class="w-full">
    <div class="flex justify-end w-full pb-2 -mb-px" wire:loading>
        <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>
    <div wire:loading.remove>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="divide-y divide-slate-200">
                @foreach ($tasks->groupBy('team.name') as $k_task => $v_task)
                    <div class="font-medium py-2 text-lg">{{ $k_task }}</div>
                    @foreach ($v_task as $networkTask)
                        <div @class([
                            'flex',
                            'justify-between',
                            'items-center',
                            'space-x-4',
                            'px-2',
                            'py-1.5',
                            'bg-teal-50' => !is_null($networkTask->is_completed),
                            'bg-slate-50' =>
                                $networkTask->status_name == 'New' &&
                                is_null($networkTask->is_completed),
                        ])>
                            <div class="w-1/3 text-sm flex-1 flex flex-row items-center">
                                <div @class(['font-medium', 'truncate', 'w-full'])>
                                    @if (!is_null($networkTask->task->parent))
                                        @if (!is_null($networkTask->task->parent->networktask->is_completed) ||
                                        !is_null($networkTask->is_completed) && !is_null($networkTask->task->parent->status))
                                            <a href="#" @class([
                                                'hover:underline',
                                                'flex',
                                                'justify-start',
                                                'w-full',
                                                'items-center',
                                                'font-bold' => !is_null($networkTask->is_completed),
                                                'text-teal-500' => !is_null($networkTask->is_completed),
                                            ])
                                                wire:click="taskInfo({{ $networkTask->id }})">
                                                @if (!is_null($networkTask->task->parent_id))
                                                    <x-tooltip>
                                                        @lang('This task relies on: :dependency.', ['dependency' => $networkTask->task->parent->name])
                                                    </x-tooltip>
                                                @endif
                                                <span>{{ $networkTask->task->name }}</span>
                                            </a>
                                        @else
                                            <div class="flex justify-start w-full items-center">
                                                @if (!is_null($networkTask->task->parent_id))
                                                    <x-tooltip>@lang('This task relies on: :dependency. The related task need to be completed.', ['dependency' => $networkTask->task->parent->name])</x-tooltip>
                                                @endif
                                                <span class="text-red-500">{{ $networkTask->task->name }}</span>
                                            </div>
                                        @endif
                                    @else
                                        <a href="#" @class([
                                            'hover:underline',
                                            'flex',
                                            'justify-start',
                                            'w-full',
                                            'items-center',
                                            'font-bold' => !is_null($networkTask->is_completed),
                                            'text-teal-500' => !is_null($networkTask->is_completed),
                                        ])
                                            wire:click="taskInfo({{ $networkTask->id }})">
                                            @if (!is_null($networkTask->task->parent_id))
                                                <x-tooltip>
                                                    @lang('This task relies on: :dependency', ['dependency' => $networkTask->task->parent->name])
                                                </x-tooltip>
                                            @endif
                                            <span>{{ $networkTask->task->name }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="flex text-left text-slate-400 space-x-2 items-center align-middle">
                                <div class="ml-2">
                                    @if (is_null($networkTask->is_completed))
                                        <x-badge :label="$networkTask->status_name" squared :color="$networkTask->status_color" />
                                    @else
                                        <x-badge :label="trans('Completed')" squared color="violet" />
                                    @endif
                                </div>
                                <div class=" text-slate-400">
                                    <x-icon name="chat-alt-2" class="w-5 h-5 inline-block" />
                                    {{ $networkTask->comments_count }}
                                </div>
                                <div class=" text-slate-400">
                                    <x-icon name="clipboard-list" class="w-5 h-5 inline-block" />
                                    {{ $networkTask->complete_checklists_count }}/{{ $networkTask->checklists_count }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="flex justify-end w-full py-2 -mb-px mt-5 " wire:loading>
                <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
            @if (!is_null($taskInfoSection))
                <div wire:loading.remove>
                    <div
                        class="flex justify-between text-slate-500 border-b border-slate-200 text-xs mb-2 pb-2 align-middle items-center">
                        <h3 class="font-medium text-lg">
                            {{ $taskInfoSection->task->name }}
                        </h3>
                        <span>
                            @if (!is_null($taskInfoSection->task->parent_id))
                                @lang('This task relies on: :dependency', ['dependency' => $taskInfoSection->task->parent->name])
                            @endif
                        </span>
                        <x-taskSectionDropdown :data="$taskInfoSection" />
                    </div>
                    <div class="flex justify-start space-x-2 pb-4">
                        @if (is_null($taskInfoSection->is_completed))
                            <x-badge :label="$taskInfoSection->status_name" squared :color="$taskInfoSection->status_color" />
                        @else
                            <x-badge :label="trans('Completed')" squared color="violet" />
                        @endif

                        <x-badge :label="$taskInfoSection->badgepriorityname" squared :color="$taskInfoSection->badgeprioritycolor" />
                    </div>
                    @if (!is_null($taskInfoSection->is_completed))
                        <div class="pb-4 grid grid-cols-1">
                            <div class="font-medium mb-2 pb-2 text-slate-600 border-b border-slate-200">
                                @lang('Completed task')</div>
                            <div class="grid grid-cols-4 gap-4 text-sm pb-1">
                                <div class="font-medium">@lang('Completed on')</div>
                                <div>{{ $taskInfoSectionLogActivities->created_at ?? '' }}</div>
                            </div>
                            <div class="grid grid-cols-4 gap-4 text-sm pb-1">
                                <div class="font-medium">@lang('Completed by')</div>
                                <div>{{ $taskInfoSectionLogActivities->causer->name ?? '' }}</div>
                            </div>

                        </div>
                    @endif
                    <div class="flex justify-between pb-4 text-slate-400">
                        <div class="grid grid-cols-1">
                            <div class="font-medium text-slate-600">@lang('Assign to')</div>
                            <div class="text-sm">{{ $taskInfoSection->team->name }}</div>
                        </div>
                        <div class="grid grid-cols-1">
                            <div class="font-medium text-slate-600">@lang('Due to')</div>
                            <div class="text-sm ">
                                <x-icon name="calendar" class="w-4 h-4 inline-block mr-1" />
                                {{ $taskInfoSection->due_date }}
                            </div>
                        </div>
                    </div>
                    <div class="pb-4 grid grid-cols-1">
                        <div class="font-medium pb-2 text-slate-600">@lang('Statuses history')</div>
                        <div
                            class="text-sm flex space-x-4 max-h-64 overflow-hidden hover:overflow-auto soft-scrollbar transition-all ease-in-out duration-500">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-2 py-1.5 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                            @lang('Status')</th>
                                        <th
                                            class="px-2 py-1.5 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                            @lang('Employee')</th>
                                        <th
                                            class="px-2 py-1.5 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                            @lang('Reason')</th>
                                        <th
                                            class="px-2 py-1.5 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                            @lang('Created')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($taskInfoSection->statuses as $status)
                                        <tr>
                                            <td class="px-2 py-1.5 border-b border-slate-200 bg-white text-sm">
                                                <p class="text-slate-900 whitespace-no-wrap text-left">
                                                    {{ $status->status_name }}</p>
                                            </td>
                                            <td class="px-2 py-1.5 border-b border-slate-200 bg-white text-sm">
                                                <p class="text-slate-900 whitespace-no-wrap text-left">
                                                    {{ $status->creator->name ?? '' }}</p>
                                            </td>
                                            <td class="px-2 py-1.5 border-b border-slate-200 bg-white text-sm">
                                                <p class="text-slate-900 whitespace-no-wrap text-left">
                                                    {{ Str::limit($status->reason, 25, '...') }}</p>
                                            </td>
                                            <td class="px-2 py-1.5 border-b border-slate-200 bg-white text-sm">
                                                <p class="text-slate-900 whitespace-no-wrap text-left">
                                                    {{ $status->created_at->toDateTimeString() }}</p>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 pb-4">
                        <livewire:ratt.checklists.checklist :model="$taskInfoSection"
                            :wire:key="'checklists-'.$taskInfoSection->id" />
                    </div>
                    @can('attachments-view')
                        <div class="grid grid-cols-1 divide-y divide-slate-200">
                            <div class="pb-2 font-bold flex justify-between items-center align-middle">
                                @lang('Attachments')
                                @can('attachments-create')
                                    <x-button :label="trans('Add files')" flat slate squared xs
                                        onclick="Livewire.emit('openModal', 'ratt.networks.attach-files', {{ json_encode(['model_id' => $taskInfoSection->id, 'model' => App\Models\NetworkTask::class]) }})" />
                                @endcan
                            </div>
                            <livewire:ratt.networks.attachments :model="$taskInfoSection" />
                        </div>
                    @endcan
                    @can('comments-view')
                        <div class="grid grid-cols-1">
                            <livewire:comments.comments :model="$taskInfoSection" :wire:key="'comments-'.$taskInfoSection->id" />
                        </div>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</div>
