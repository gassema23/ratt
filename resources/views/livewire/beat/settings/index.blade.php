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
        @switch($openSection)
            @case('alarm_catalog')
                <x-card>
                    alarm_catalog case...
                </x-card>
            @break

            @case('alarm_category')
                <div class="flex justify-end mb-4">
                    <x-button teal squared :label="trans('New category')" onclick="Livewire.emit('openModal', 'beat.alarms.categories.create')"
                        :key="time() . 'alarm_category'" id="alarm_category_create" />
                </div>
                <x-card>
                    @livewire('beat.alarms.categories.table')
                </x-card>
            @break

            @case('alarm_type')
                alarm_type case...
            @break

            @case('severities')
                severities case...
            @break

            @case('specifications')
                specifications case...
            @break

            @case('system_type')
                system_type case...
            @break

            @case('alarm_status')
                alarm_status case...
            @break

            @case('switch_type')
                switch_type case...
            @break

            @case('generator_type')
                generator_type case...
            @break

            @default
                Default case...
        @endswitch
    </div>
</div>
