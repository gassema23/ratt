<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                @lang('Import milestone CSV file')
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-1 gap-4">
                    <x-input type="file" wire:model.defer="csv_file" :label="trans('Import CSV file')" :hint="trans('Field required')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
