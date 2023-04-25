<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('Update :name', ['name' => $documentation->name]) }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model="documentation.category_id" :options="$categories" option-value="id" autocomplete="off"
                        option-label="name" :placeholder="__('Make a selection')" :label="__('Category')" />

                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="documentation.name" :label="__('Title')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-1 gap-4">
                    <livewire:trix :value="$documentation->description">
                </div>
                <div class="my-2 grid grid-cols-1 gap-4">
                    <x-input type="file" wire:model.defer="attachment" multiple :label="trans('Attachments')" :hint="trans('Accept only PDF, XSLX, DOC')" />
                </div>
                <div wire:loading class="flex w-full gap-2">
                    <svg class="animate-spin w-4 h-4 shrink-0 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>@lang('Importing file...')</span>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
