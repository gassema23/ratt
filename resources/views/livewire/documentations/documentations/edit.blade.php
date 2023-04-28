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
                    <div x-data="{ tags: @entangle('tags').defer }">
                        <div x-on:keydown.enter.prevent="tags.push($refs.tagInput.value); $refs.tagInput.value = ''">
                            <x-input x-ref="tagInput" placeholder="Add tag..." :label="trans('Tag')">
                                <x-slot name="append">
                                    <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                        <x-button class="h-full rounded-r-md" icon="check" spinner teal flat squared
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
                                        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                            <path stroke-linecap="round" d="M1 1l6 6m0-6L1 7" />
                                        </svg>
                                    </button>
                                </span>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-input wire:model.defer="documentation.name" :label="__('Title')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-1 gap-4">
                    <livewire:trix :value="$documentation->description">
                </div>
                <div class="my-2 grid grid-cols-1 gap-4">
                    <x-input type="file" wire:model.defer="attachment" multiple :label="trans('Attachments')"
                        :hint="trans('Accept only PDF, XSLX, DOC')" />
                </div>
                <div wire:loading class="flex w-full gap-2">
                    <svg class="animate-spin w-4 h-4 shrink-0 inline-block" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
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
