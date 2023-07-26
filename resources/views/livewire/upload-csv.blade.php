<div>
    <x-app-modal>
        <x-slot name="title">
            @lang('Upload new file')
        </x-slot>
        <x-slot name="content">
             @dump($data)
        </x-slot>

        <x-slot name="action">
            @if (!empty($csv_data))
                <x-button squared teal :label="trans('Import')" wire:click="processImport" spinner="processImport" />
            @endif
            <x-button squared slate :label="trans('Upload CSV')" wire:click="parseFile" spinner="parseFile" />
        </x-slot>
    </x-app-modal>
</div>
