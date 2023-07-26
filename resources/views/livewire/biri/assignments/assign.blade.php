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
                    @lang('General information')
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input :label="trans('Fox order')" wire:model.defer="fox_order" />
                    <x-inputs.number :label="trans('Priority')" wire:model.defer="priority" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model.defer="technology_id" :options="$technologies" option-value="id" autocomplete="off"
                        option-label="label" :placeholder="__('Make a selection')" :label="__('Technology')" :hint="trans('Field required')" />
                    <x-select wire:model.defer="equipment_id" :options="$equipments" option-value="id" autocomplete="off"
                        option-label="label" :placeholder="__('Make a selection')" :label="__('Equipment')" :hint="trans('Field required')" />
                    <x-select wire:model.defer="activity_id" :options="$activities" option-value="id" autocomplete="off"
                        option-label="label" :placeholder="__('Make a selection')" :label="__('Activity')" :hint="trans('Field required')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
