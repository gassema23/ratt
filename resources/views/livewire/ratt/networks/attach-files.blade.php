<div>
    <x-app-modal x-data>
        <form wire:submit.prevent="save">
            <x-slot name="title">{{ __('Attach files') }}</x-slot>
            <x-slot name="content">
                <x-errors class="my-2" />
                <div class="my-2" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="border-2 border-gray-200 p-3 w-full block rounded cursor-pointer my-2"
                        for="customFile" x-data="{ files: null }">
                        <input wire:model.defer="attachment" type="file" class="sr-only" id="customFile"
                            x-on:change="files = Object.values($event.target.files)">
                        <span x-text="files ? files.map(file => file.name).join(', ') : '{{ trans('Select file... (jpeg,jpg,png,pdf)') }}'"></span>
                    </label>
                    <div x-show="isUploading" class="w-full">
                        <progress class="w-full h-2" max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
            </x-slot>
            <x-slot name="action">
                <x-button type="button" squared wire:click.prevent="save" positive spinner="save" :label="__('Save')" />
            </x-slot>
        </form>
    </x-app-modal>
</div>
