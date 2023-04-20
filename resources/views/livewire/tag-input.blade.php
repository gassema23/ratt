<div x-data="{ tags: @entangle('tags').defer }">
    <div x-on:keydown.enter.prevent="tags.push($refs.tagInput.value); $refs.tagInput.value = ''">
        <x-input x-ref="tagInput" placeholder="Add tag..." :label="trans('Tag')">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button
                        class="h-full rounded-r-md"
                        icon="check"
                        spinner
                        teal
                        flat
                        squared
                        x-on:click="tags.push($refs.tagInput.value); $refs.tagInput.value = ''"
                    />
                </div>
            </x-slot>
        </x-input>
    </div>
    <div>
        <template x-for="(tag, index) in tags" :key="index">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-sm font-medium bg-teal-100 text-teal-800 mr-2 my-2">
                <span x-text="tag"></span>
                <button type="button" x-on:click="tags.splice(index, 1)" class="flex-shrink-0 ml-1 inline-flex text-teal-500 focus:outline-none focus:text-teal-700">
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" d="M1 1l6 6m0-6L1 7" />
                    </svg>
                </button>
            </span>
        </template>
    </div>
</div>
