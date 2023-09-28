<div>
    <x-app-modal>
        <x-slot name="title">
            @lang('Network #:network, :header', [
                'network' => $assignation->network_no,
                'header' => $assignation->isq->network_header,
            ])
        </x-slot>
        <x-slot name="content">
            <div x-data="{ selected: null }" class="mb-4">
                <div @click="selected !== 1 ? selected = 1 : selected = null"
                    class="px-4 py-2 font-bold text-slate-600 uppercase border-b border-slate-100 flex justify-between hover:bg-slate-50 cursor-pointer"
                    :class="selected == 1 ? 'bg-slate-50' : ''">
                    <div>@lang('General informations')</div>
                    <div :class="selected == 1 ? 'rotate-180' : 'rotate-0'" class="duration-700 transition-all">
                        <x-icon name="chevron-down" class="w-5 h-5" />
                    </div>
                </div>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1"
                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Projet')</p>
                        <p>{{ $assignation->isq->project_no }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Network')</p>
                        <p>{{ $assignation->network_no }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('SAP header')</p>
                        <p>{{ $assignation->isq->network_header }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Project name')</p>
                        <p>{{ $assignation->milestone->label }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('CLLI')</p>
                        <p>{{ $assignation->isq->clli_name }}</p>
                    </div>
                </div>
                <div @click="selected !== 2 ? selected = 2 : selected = null"
                    class="px-4 py-2 font-bold text-slate-600 uppercase border-b border-slate-100 flex justify-between hover:bg-slate-50 cursor-pointer"
                    :class="selected == 2 ? 'bg-slate-50' : ''">
                    <div>@lang('Order informations')</div>
                    <div :class="selected == 2 ? 'rotate-180' : 'rotate-0'" class="duration-700 transition-all">
                        <x-icon name="chevron-down" class="w-5 h-5" />
                    </div>
                </div>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                    x-ref="container2"
                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('FOX')</p>
                        <p>{{ $assignation->fox_order ?? 'N/A' }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Priority')</p>
                        <p>{{ $assignation->priority }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Technology')</p>
                        <p>{{ $assignation->activity->technology->label }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Equipment')</p>
                        <p>{{ $assignation->activity->equipment->label }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Category activity')</p>
                        <p>{{ $assignation->activity->category->label }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Activity')</p>
                        <p>{{ $assignation->activity->description }}</p>
                    </div>
                </div>
                <div @click="selected !== 3 ? selected = 3 : selected = null"
                    class="px-4 py-2 font-bold text-slate-600 uppercase border-b border-slate-100 flex justify-between hover:bg-slate-50 cursor-pointer"
                    :class="selected == 3 ? 'bg-slate-50' : ''">
                    <div>@lang('DESN')</div>
                    <div :class="selected == 3 ? 'rotate-180' : 'rotate-0'" class="duration-700 transition-all">
                        <x-icon name="chevron-down" class="w-5 h-5" />
                    </div>
                </div>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                    x-ref="container3"
                    x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('DESN name')</p>
                        <p>{{ $assignation->desnTech->name }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('DESN status')</p>
                        @if (isset($assignation->lastDesnCompleted()->first()->datas['desn_completed_at']))
                            <p>{{ config('biri.App_desn_statuses.' . App::getLocale())[$desn_status]['name'] }}</p>
                        @else
                            <x-native-select wire:model.defer="desn_status" :options="config('biri.App_desn_statuses.' . App::getLocale())" option-value="id"
                                autocomplete="off" option-label="name" :placeholder="__('Make a selection')" />
                        @endif
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('DESN status reason')</p>
                        @if (isset($assignation->lastDesnCompleted()->first()->datas['desn_completed_at']))
                            <p>{{ $desn_reason }}</p>
                        @else
                            <x-textarea wire:model.defer="desn_reason" :placeholder="trans('Your reason')" />
                        @endif
                    </div>
                    @if (!isset($assignation->lastDesnCompleted()->first()->datas['desn_completed_at']))
                        <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                            <p class="text-slate-600 font-semibold">@lang('Save')</p>
                            <div class="items-end flex justify-end">
                                <x-button.circle xs positive icon="check" wire:click="saveDesn" spinner="saveDesn" />
                            </div>
                        </div>
                    @endif
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('DESN required at')</p>
                        <p>{{ $assignation->desn_req->format('Y-m-d') }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('Engineering sheet required at')</p>
                        <p>{{ $assignation->fich_eng_req->format('Y-m-d') }}</p>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('DESN completed at')</p>
                        @if (isset($assignation->lastDesnCompleted()->first()->datas['desn_completed_at']))
                            <p>
                                {{ Carbon\Carbon::parse($assignation->lastDesnCompleted()->first()->datas['desn_completed_at'])->format('Y-m-d') }}
                            </p>
                        @else
                            <x-button squared slate :label="trans('Complete')" wire:click="complete" spinner="complete" />
                        @endif
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('DESN comments')</p>
                        <div>
                            <div class="flex justify-between items-end align-bottom space-x-4">
                                <div class="w-full">
                                    <x-textarea wire:model.defer="desn_comment" :placeholder="trans('DESN comments')" />
                                </div>
                                <x-button.circle xs positive icon="check" wire:click="saveDesnComment"
                                    spinner="saveDesn" />
                            </div>
                            <ol class="border-l border-slate-300 dark:border-slate-500 mt-4">
                                @forelse($assignation->AllDesnComments as $desn_comment)
                                    <!--First item-->
                                    <li>
                                        <div class="flex-start flex items-center pt-3">
                                            <div
                                                class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-slate-300 dark:bg-slate-500">
                                            </div>
                                            <p class="text-sm text-slate-500 dark:text-slate-300">
                                                {{ $desn_comment->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="mb-6 ml-4 mt-2">
                                            <h4 class="mb-1.5 text-xl font-semibold">{{ $desn_comment->creator->name }}
                                            </h4>
                                            <p class="mb-3 text-slate-500 dark:text-slate-300">
                                                {{ $desn_comment->datas['desn_comment'] }}
                                            </p>
                                        </div>
                                    </li>
                                @empty
                                    <!--First item-->
                                    <li class=" ml-4">
                                        <p class="mb-3 text-slate-500 dark:text-slate-300">
                                            @lang('No comment yet...')
                                        </p>
                                    </li>
                                @endforelse
                            </ol>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('MAT1 ordered')</p>

                        <x-native-select wire:model.defer="desn_mat_ordered" :options="[trans('Yes'), trans('No')]" autocomplete="off"
                            :placeholder="__('Make a selection')" />
                    </div>
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('MAT1 ordered at')</p>
                        <p>##</p>
                    </div>
                </div>
                <div @click="selected !== 4 ? selected = 4 : selected = null"
                    class="px-4 py-2 font-bold text-slate-600 uppercase border-b border-slate-100 flex justify-between hover:bg-slate-50 cursor-pointer"
                    :class="selected == 4 ? 'bg-slate-50' : ''">
                    <div>@lang('Technicien')</div>
                    <div :class="selected == 4 ? 'rotate-180' : 'rotate-0'" class="duration-700 transition-all">
                        <x-icon name="chevron-down" class="w-5 h-5" />
                    </div>
                </div>
                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                    x-ref="container4"
                    x-bind:style="selected == 4 ? 'max-height: ' + $refs.container4.scrollHeight + 'px' : ''">
                    <div class="md:grid md:grid-cols-2 hover:bg-slate-50 md:space-y-0 space-y-1 px-4 py-2 border-b">
                        <p class="text-slate-600 font-semibold">@lang('FOX')</p>
                        <p>{{ $assignation->fox_order ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-app-modal>
</div>
