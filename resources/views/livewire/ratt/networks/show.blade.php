<div class="grid grid-cols-6 gap-4">
    <div class="col-span-6 md:col-span-2 2xl:col-span-1">
        <div class="flex space-y-4 flex-col">
            <x-card>
                <ul class="space-y-1">
                    <li>
                        <a href="#" wire:click="openSection('network')"
                            class="@if ($openSection === 'network') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Network')
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('scenarios')"
                            class="@if ($openSection === 'scenarios') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                            @lang('Scenarios')
                            @if ($network->networktasks->count() > 0)
                                <x-badge teal squared xs :label="$network->networktasks->count()" />
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click="openSection('timeline')" @class([
                            'flex',
                            'items-center',
                            'py-2',
                            'px-4',
                            'text-slate-800',
                            'hover:text-teal-600',
                            'hover:bg-teal-50',
                            'w-full',
                            'justify-between',
                            'transition-all',
                            'duration-300',
                            'ease-in-out',
                            'text-teal-600' => $openSection === 'timeline',
                            'bg-teal-50' => $openSection === 'timeline',
                        ])>
                            @lang('Timeline activities')
                        </a>
                    </li>
                </ul>
            </x-card>
        </div>

    </div>
    <div class="col-span-6 md:col-span-4 2xl:col-span-5">
        <x-card>
            @if ($openSection === 'network')
                @livewire('ratt.networks.sections.network-section', [$network])
            @endif
            @if ($openSection === 'scenarios')
                @livewire('ratt.networks.sections.scenario-section', [$network->id])
            @endif
            @if ($openSection === 'timeline')
                @livewire('ratt.networks.sections.timeline', [$network])
            @endif
        </x-card>
    </div>
</div>
