<div>
    <x-app-modal>

        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ trans('New alarm catalog') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <table class="min-w-full leading-normal mb-5">
                    <thead>
                        <tr>
                            <th
                                class="required px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Type')
                            </th>
                            <th
                                class="required px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Model')
                            </th>
                            <th
                                class="required px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Item number')
                            </th>
                            <th
                                class="required px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Informations')
                            </th>
                            <th
                                class="required px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Severity')
                            </th>
                            <th
                                class="px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('CTL')
                            </th>
                            <th
                                class="px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Verb 1')
                            </th>
                            <th
                                class="px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Verb 2')
                            </th>
                            <th
                                class="px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('I/O terminal')
                            </th>
                            <th
                                class="px-2 py-3 border-b-2 border-slate-200 bg-slate-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                @lang('Document code')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-select wire:model.defer="alarm_type_id" :options="$types" option-value="id"
                                    autocomplete="off" option-label="label" :placeholder="__('Make a selection')" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="model" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="item_number" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-textarea wire:model.defer="description" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-select wire:model.defer="alarm_severity_id" :options="$severities" option-value="id"
                                    autocomplete="off" option-label="label" :placeholder="__('Make a selection')" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="ctl" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="verb1" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="verb2" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="io_terminal" />
                            </td>
                            <td class="px-2 py-5 border-b border-slate-200 bg-white text-sm">
                                <x-input wire:model.defer="document_code" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="trans('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
