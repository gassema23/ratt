<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                @if ($isUpdated)
                    {{ __('Update :name', ['name' => $categoryactivity->name]) }}
                @else
                    {{ __('New category activity') }}
                @endif
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="categoryactivity.label.en" :label="__('Category activity [EN]')" :hint="trans('Field required')" />
                    <x-input wire:model.defer="categoryactivity.label.fr" :label="__('Category activity [FR]')" />
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-textarea wire:model.defer="categoryactivity.description.en" :label="trans('Description [EN]')" />
                    <x-textarea wire:model.defer="categoryactivity.description.fr" :label="trans('Description [FR]')" />
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
