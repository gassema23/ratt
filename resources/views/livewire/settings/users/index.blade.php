<div>
    <x-slot name="sidebar">
        @role(['Super-Admin', 'Admin'])
            <x-card>
                @if (empty($section_name))
                    @if (\Request::query('s') == 'active')
                        @dump('AC')
                    @endif
                @elseif($section_name == 'active')
                    @dump('AC2')
                @endif
                @if (empty($section_name))
                    @if (\Request::query('s') == 'pending')
                        @dump('PE')
                    @endif
                @elseif($section_name == 'pending')
                    @dump('PE2')
                @endif
                <div class="text-xl font-bold mb-4">@lang('Filter')</div>
                <ul class="space-y-2">
                    <li>
                        <a href="#" onclick="Livewire.emit('sectionFilter',{{ json_encode('active') }})"
                            class="@if (\Request::query('s') === 'active') text-teal-600 bg-teal-50 @endif font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Active employees')
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="Livewire.emit('sectionFilter',{{ json_encode('pending') }})"
                            class="@if (\Request::query('s') === 'pending') text-teal-600 bg-teal-50 @endif font-semibold flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Pending invitation')
                            @if ($innactiveCount > 0)
                                <x-badge negative outline flat :label="$innactiveCount">
                                    <x-slot name="append" class="relative flex items-center w-2 h-2 ml-2">
                                        <span
                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-red-500 animate-ping"></span>
                                        <span class="relative inline-flex w-2 h-2 rounded-full bg-red-500"></span>
                                    </x-slot>
                                </x-badge>
                            @endif
                        </a>
                    </li>
                </ul>
            </x-card>
        @endcan
    </x-slot>
    <div class="">
        <x-card>
            @livewire('settings.users.table')
        </x-card>
    </div>
</div>
