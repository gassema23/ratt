<div>
    <x-app-modal>
        <form wire:submit.prevent="save">
            <x-slot name="title">
                {{ __('New documentation') }}
            </x-slot>
            <x-slot name="content">
                <x-errors class="my-2 " />
                <div class="my-2 grid grid-cols-2 gap-4">
                    <x-select wire:model.defer="category_id" :options="$categories" option-value="id" autocomplete="off"
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
                    <x-input wire:model.defer="name" :label="__('Title')" :hint="trans('Field required')" />
                </div>
                <div class="my-2 grid grid-cols-1 gap-4">
                    <livewire:trix >
                </div>
                <div class="my-2" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label class="border-2 border-gray-200 p-3 w-full block rounded cursor-pointer my-2"
                        for="customFile" x-data="{ files: null }">
                        <input wire:model.defer="attachment" type="file" class="sr-only" id="customFile"
                            x-on:change="files = Object.values($event.target.files)">
                        <span
                            x-text="files ? files.map(file => file.name).join(', ') : '{{ trans('Select file... (jpeg,jpg,png,pdf)') }}'"></span>
                    </label>
                    <div x-show="isUploading" class="w-full">
                        <progress class="w-full h-2" max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" wire:click.prevent="save" squared positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
