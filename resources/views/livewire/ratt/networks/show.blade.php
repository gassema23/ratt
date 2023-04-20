<div class="grid grid-cols-1 md:grid-cols-4 xl:grid-cols-6 gap-4">
    <div class="gap-4 col-span-1 xl:col-span-5 md:col-span-3">
        @if ($openSection === 'network')
            @livewire('ratt.networks.sections.network-section', ['network' => $network])
        @elseif ($openSection === 'task')
            @livewire('ratt.networks.sections.task-section', ['network' => $network])
        @elseif ($openSection === 'timeline')
            @livewire('ratt.networks.sections.timeline', ['network' => $network])
        @endif
    </div>
    <div class="col-span-1 order-first md:order-last text-sm ">
        <x-card>
            <div class="border-l-2 border-slate-50 text-slate-600 p-3 hover:border-l-2 hover:border-teal-500 transition ease-in-out duration-300 hover:bg-slate-50 cursor-pointer @if ($openSection === 'network') border-teal-400 text-teal-500 @endif"
                wire:click="openSection('network')">
                <div class="grid grid-cols-4">
                    <div class="col-span-1">
                        <x-icon name="globe-alt" class="w-6 h-6" />
                    </div>
                    <div class="col-span-3">
                        <div class="font-medium">@lang('Network')</div>
                        <div class="text-xs text-slate-400">@lang('Network description')</div>
                    </div>
                </div>
            </div>
            <div class="border-l-2 border-slate-50 text-slate-600 p-3 hover:border-l-2 hover:border-teal-500 transition ease-in-out duration-300 hover:bg-slate-50 cursor-pointer @if ($openSection === 'task') border-teal-400 text-teal-500 @endif"
                wire:click="openSection('task')">
                <div class="grid grid-cols-4">
                    <div class="col-span-1">
                        <x-icon name="clipboard-list" class="w-6 h-6" />
                    </div>
                    <div class="col-span-3">
                        <div class="font-medium">@lang('Tasks')</div>
                        <div class="text-xs text-slate-400">@lang('Assign network')</div>
                    </div>
                </div>
            </div>
            <div class="border-l-2 border-slate-50 p-3 hover:border-l-2 hover:border-teal-500 transition ease-in-out duration-300 hover:bg-slate-50 cursor-pointer @if ($openSection === 'timeline') border-teal-400 text-teal-500 @endif"
                wire:click="openSection('timeline')">
                <div class="grid grid-cols-4">
                    <div class="col-span-1">
                        <x-icon name="clock" class="w-6 h-6" />
                    </div>
                    <div class="col-span-3">
                        <div class="font-medium">@lang('Timeline activity')</div>
                        <div class="text-xs text-slate-400">@lang('Manage daily activity and updates')</div>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>
