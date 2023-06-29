<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update network :name', ['name' => $network->network_no]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="flex w-full text-sm space-x-4 border-b border-slate-200 pb-4 mb-4">
                    <div>@lang('Project started at :date', ['date' => $network->project->started_at->toFormattedDayDateString()])</div>
                    <div>@lang('Project ended at :date', ['date' => $network->project->ended_at->toFormattedDayDateString()])</div>
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <div>
                        <div class="my-2">
                            <x-input wire:model.defer="network.name" :label="__('Network name')" :hint="trans('Field required')" />
                        </div>
                        <div class="my-2">
                            <x-input wire:model.defer="network.network_no" :label="__('Network number')" :hint="trans('Field required (1234567)')" />
                        </div>
                        <div class="grid grid-cols-2 gap-4 my-2">
                            <x-datetime-picker :label="__('Started date')" wire:model.defer="network.started_at" without-time
                                :hint="trans('Field required')" />
                            <x-datetime-picker :label="__('Ended date')" wire:model.defer="network.ended_at" without-time
                                :hint="trans('Field required')" />
                        </div>
                    </div>
                    <div>
                        <div class="my-2">
                            <x-select wire:model="site_id" :options="$sites" option-value="id" autocomplete="off"
                                option-label="clli" option-description="name" :placeholder="__('Make a selection')" :label="__('Clli')"
                                :hint="trans('Field required')" />
                        </div>
                        <div class="my-2">
                            <div x-data="{ tags: @entangle('tags').defer }">
                                <div
                                    x-on:keydown.enter.prevent="tags.push($refs.tagInput.value); $refs.tagInput.value = ''">
                                    <x-input x-ref="tagInput" placeholder="Add network element..." :label="trans('Network element')">
                                        <x-slot name="append">
                                            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                                <x-button class="h-full rounded-r-md" icon="check" spinner teal flat
                                                    squared
                                                    x-on:click="tags.push($refs.tagInput.value); $refs.tagInput.value = ''" />
                                            </div>
                                        </x-slot>
                                    </x-input>
                                </div>
                                <div>
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded text-sm font-medium bg-teal-100 text-teal-800 mr-2 my-2">
                                            <span x-text="tag"></span>
                                            <button type="button" x-on:click="tags.splice(index, 1)"
                                                class="flex-shrink-0 ml-1 inline-flex text-teal-500 focus:outline-none focus:text-teal-700">
                                                <svg class="h-2 w-2" stroke="currentColor" fill="none"
                                                    viewBox="0 0 8 8">
                                                    <path stroke-linecap="round" d="M1 1l6 6m0-6L1 7" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 my-2">
                    <livewire:trix :value="$network->description">
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
