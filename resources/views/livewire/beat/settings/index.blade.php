<div class="grid grid-cols-6 gap-4">
    <div class="col-span-6 md:col-span-2 2xl:col-span-1">
        <div class="flex space-y-4 flex-col">
            <x-card>
                <ul class="space-y-1">
                    <li>
                        <a href="#" wire:click="openSection('alarm_catalog')"
                            class="@if ($openSection === 'alarm_catalog') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Alarm catalog')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('alarm_category')"
                            class="@if ($openSection === 'alarm_category') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Alarm category')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('alarm_type')"
                            class="@if ($openSection === 'alarm_type') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Alarm type')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('severities')"
                            class="@if ($openSection === 'severities') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Severities')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('specifications')"
                            class="@if ($openSection === 'specifications') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Specifications')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('system_type')"
                            class="@if ($openSection === 'system_type') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('System type')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('alarm_status')"
                            class="@if ($openSection === 'alarm_status') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Alarm status')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('switch_type')"
                            class="@if ($openSection === 'switch_type') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Switch type')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('generator_type')"
                            class="@if ($openSection === 'generator_type') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Generator type')
                        </a>
                    </li>
                </ul>
            </x-card>
        </div>
    </div>
    <div class="col-span-6 md:col-span-4 2xl:col-span-5">
        <div wire:loading class="flex w-full transition ease-in-out duration-500">
            <x-card>
                <div class="flex justify-start w-full pb-2 -mb-px">
                    <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </x-card>
        </div>
        <div wire:loading.remove>
            @switch($openSection)
                @case('alarm_catalog')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm catalog')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.lists.create')" :key="time() . 'alarm_lists'"
                            id="alarm_lists_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.lists.table')
                    </x-card>
                @break

                @case('alarm_category')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm category')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.categories.create')" :key="time() . 'alarm_category'"
                            id="alarm_category_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.categories.table')
                    </x-card>
                @break

                @case('alarm_type')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm type')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.types.create')" :key="time() . 'alarm_type'"
                            id="alarm_type_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.types.table')
                    </x-card>
                @break

                @case('severities')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm severity')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.severities.create')" :key="time() . 'alarm_severity'"
                            id="alarm_severity_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.severities.table')
                    </x-card>
                @break

                @case('specifications')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm specification')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.specifications.create')" :key="time() . 'alarm_specification'"
                            id="alarm_specification_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.specifications.table')
                    </x-card>
                @break

                @case('system_type')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New system type')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.systems.types.create')" :key="time() . 'alarm_system_types'"
                            id="alarm_system_type_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.systems.types.table')
                    </x-card>
                @break

                @case('alarm_status')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm status')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.statuses.create')" :key="time() . 'alarm_status'"
                            id="alarm_status_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.statuses.table')
                    </x-card>
                @break

                @case('switch_type')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New alarm switch type')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.switchs.create')" :key="time() . 'alarm_switch_type'"
                            id="alarm_switch_type_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.switchs.table')
                    </x-card>
                @break

                @case('generator_type')
                    <div class="flex justify-end mb-4">
                        <x-button teal squared :label="trans('New generator type')"
                            onclick="Livewire.emit('openModal', 'beat.settings.alarms.generators.create')" :key="time() . 'alarm_generator_type'"
                            id="alarm_generator_type_create" />
                    </div>
                    <x-card>
                        @livewire('beat.settings.alarms.generators.table')
                    </x-card>
                @break

                @default
                    Default case...
            @endswitch
        </div>
    </div>
</div>
