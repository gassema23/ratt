<div>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-4 space-y-4">
            @if (auth()->user()->id == $user->id ||
                    auth()->user()->hasRole(['Super-Admin', 'Admin']))
                <x-card>
                    <div class="font-bold text-slate-600">@lang('Recent activity')</div>
                    <div class="flex flex-col space-y-2 mt-4">
                        @foreach ($activities as $activity)
                            <div class="w-full flex space-x-2">
                                <div class="text-slate-500 text-xs font-normal">
                                    {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                </div>
                                <div class="text-slate-500 text-xs">
                                    <span class="font-bold">{{ $activity->description }}</span>
                                    @if ($activity->subject)
                                        @if (!is_null($activity->subject->name))
                                            {{ $activity->subject->name }}
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
                <x-card>
                    <div class="font-bold text-slate-600">@lang('Projects')</div>
                    <div class="flex flex-col mt-4 max-h-80 overflow-hidden hover:overflow-auto soft-scrollbar transition-all ease-in-out duration-500">
                        @foreach ($projects as $project)
                            <div class="text-slate-600 font-medium">
                                <a href="{{ route('admin.ratt.projects.show', $project->id) }}"
                                    class="text-teal-500 hover:underline">
                                    {{ 'P-'.$project->project_no }}
                                </a>
                            </div>
                            @foreach ($project->networks as $network)
                                <div class="pl-2">
                                    @if ($network->networktasks->count() > 0)
                                        <div class="text-slate-600 font-medium mt-4 text-sm">
                                            <a href="{{ route('admin.ratt.networks.show', $network->id) }}"
                                                class="text-teal-500 hover:underline">
                                                {{ $network->network_no }}
                                            </a>
                                        </div>
                                        <div class="divide-y divide-slate-200">
                                            @foreach ($network->networktasks as $task)
                                                <div class="flex justify-between py-2 pl-2">
                                                    <div class="text-slate-500 text-sm font-medium w-3/4">
                                                        {{ $task->task->name }}
                                                    </div>
                                                    <div
                                                        class="grid grid-cols-4 text-slate-400 justify-end items-center align-middle w-1/4">
                                                        <div class="col-span-1 text-xs">
                                                            <x-icon name="clipboard-list"
                                                                class="w-4 h-4 inline-block" />
                                                            {{ $task->checklistscompletes_count . '/' . $task->checklists_count }}
                                                        </div>
                                                        <div class="col-span-1 text-xs">
                                                            <x-icon name="chat-alt" class="w-4 h-4 inline-block" />
                                                            {{ $task->comments_count }}
                                                        </div>
                                                        <div class="col-span-2">
                                                            <x-badge :label="$task->badgepriorityname" squared :color="$task->badgeprioritycolor" />
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </x-card>
            @endrole
    </div>
    <div class="col-span-2">
        <x-card>
            <div class="flex justify-between">
                <div class="font-bold text-slate-600 mb-4">@lang('Personal informations')</div>
                @can('users-edit')
                    <div>
                        <a href="#" class="text-teal-500 hover:underline"
                            onclick="Livewire.emit('openModal', 'settings.users.edit', {{ json_encode([$user->id]) }})">
                            <x-icon name="pencil-alt" class="w-4 h-4 inline-block" />
                            @lang('Edit')
                        </a>
                    </div>
                @endcan
            </div>
            <div class="hover:grayscale transition-all duration-500 ease-in-out flex space-x-4 items-center align-middle my-4">
                <div>
                    <x-avatar src="{{ $user->gravatar }}" size="w-24 h-24" class="" />
                </div>
                <div>
                    <div class="font-bold text-slate-600">{{ $user->name }}</div>
                    <div class="text-slate-400 text-xs">{{ $user->employe_id }}</div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 text-slate-600 ">
                <div class="flex items-center align-middle space-x-2 truncate">
                    <div>
                        <x-icon name="mail" class="w-6 h-6" />
                    </div>
                    <div>
                        <div class="text-sm truncate">
                            <a href="mailto:{{ $user->email }}" class="text-teal-500 hover:underline"
                                target="_BLANK">
                                {{ $user->email }}</a>
                        </div>
                        <div class="text-slate-400 text-xs ">@lang('Email address')</div>
                    </div>
                </div>
                <div class="flex items-center align-middle space-x-2 truncate">
                    <div>
                        <x-icon name="device-mobile" class="w-6 h-6" />
                    </div>
                    <div>
                        <div class="text-sm">{{ $user->phoneNumber }}</div>
                        <div class="text-slate-400 text-xs">@lang('Phone number')</div>
                    </div>
                </div>
                <div class="flex items-center align-middle space-x-2 truncate">
                    <div>
                        <x-icon name="user-group" class="w-6 h-6" />
                    </div>
                    <div>
                        <div class="text-sm">{{ $user->currentTeam->name }}</div>
                        <div class="text-slate-400 text-xs ">@lang('Current team')</div>
                    </div>
                </div>
                @if (auth()->user()->hasRole(['Super-Admin', 'Admin']) || auth()->user()->id === $user->id)
                    <div class="flex items-center align-middle space-x-2 truncate">
                        <div>
                            <x-icon name="lock-open" class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="text-sm">{{ $user->getRoleNames()[0] }}</div>
                            <div class="text-slate-400 text-xs">@lang('Role')</div>
                        </div>
                    </div>
                @endrole
                <div class="flex items-center align-middle space-x-2 truncate">
                    <div>
                        <x-icon name="clock" class="w-6 h-6" />
                    </div>
                    <div>
                        <div class="text-sm">{{ \Carbon\Carbon::parse($user->lastLoginAt())->diffForHumans() }}
                        </div>
                        <div class="text-slate-400 text-xs">@lang('Last login at')</div>
                    </div>
                </div>
        </div>
    </x-card>
</div>
</div>
</div>
