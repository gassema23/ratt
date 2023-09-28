<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                @lang('Assign team member to #:network_no [:sap_header]', ['network_no' => $isq->network_no, 'sap_header' => $isq->network_header])
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <div>
                        <div class="font-bold text-slate-600 uppercase">@lang('DESN')</div>
                        <div class="grid grid-cols-1 gap-4 my-2">
                            <x-select wire:model.defer="desn_user_id" :options="$desn" option-value="id"
                                autocomplete="off" option-label="name" :placeholder="__('Make a selection')" :label="__('DESN name')" />
                        </div>

                        <div class="grid grid-cols-1 gap-4 my-2">
                            <x-datetime-picker :label="__('DESN required at')" wire:model.defer="desn_req" without-time
                                :hint="trans('Field required')" />
                        </div>
                    </div>
                    <div>
                        <div class="font-bold text-slate-600 uppercase">@lang('Technicien')</div>
                        <div class="grid grid-cols-1 gap-4 my-2">
                            <x-select wire:model.defer="tech_user_id" :options="$tech_biri" option-value="id"
                                autocomplete="off" option-label="name" :placeholder="__('Make a selection')" :label="__('Technician name')" />
                        </div>
                        <div class="grid grid-cols-1 gap-4 my-2">
                            <x-datetime-picker :label="__('Engineering sheet required at')" wire:model.defer="fich_eng_req" without-time
                                :hint="trans('Field required')" />
                        </div>
                    </div>
                </div>
                <div class="font-bold text-slate-600 uppercase">
                    @lang('General informations')
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input :label="trans('Fox order')" wire:model.defer="fox_order" />
                    <x-inputs.number :label="trans('Priority')" wire:model.defer="priority" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-4 gap-4">
                    <x-select wire:model="technology_id" :options="$technologies" option-value="technology.id"
                        autocomplete="off" option-label="technology.label" option-description="none" :placeholder="__('Make a selection')"
                        :label="__('Technology')" :hint="trans('Field required')" />
                    @if ($equipments)
                        <x-select wire:model="equipment_id" :options="$equipments" option-value="equipment.id"
                            autocomplete="off" option-label="equipment.label" option-description="none"
                            :placeholder="__('Make a selection')" :label="__('Equipment')" :hint="trans('Field required')" />
                    @endif
                    @if ($category_activities)
                        <x-select wire:model="category_activity_id" :options="$category_activities" option-value="category.id"
                            autocomplete="off" option-label="category.label" option-description="none"
                            :placeholder="__('Make a selection')" :label="__('Category activity')" :hint="trans('Field required')" />
                    @endif
                    @if ($activities)
                        <x-select wire:model="activity_id" :options="$activities" option-value="id" autocomplete="off"
                            option-label="description" option-description="none" :placeholder="__('Make a selection')" :label="__('Activity')"
                            :hint="trans('Field required')" />
                    @endif
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
