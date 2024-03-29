<div class="relative z-50" x-data="{ open: @entangle('open') }" x-show="open" x-cloak>
    <div class="fixed inset-0"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <div class="pointer-events-auto w-screen max-w-md">
                    <form wire:submit.prevent="import" class="flex h-full flex-col divide-y divide-slate-200 bg-white shadow-xl overflow-y-auto">
                        <div class="py-6 px-4 sm:px-6 dark:bg-slate-700">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-medium dark:text-slate-300">{{ __('Import') }}</h2>
                                <div class="ml-3 flex h-7 items-center">
                                    <button type="button" class="rounded-md text-teal-200 hover:text-teal-300 focus:outline-none focus:ring-2 focus:ring-white" wire:click="toggle">
                                        <span class="sr-only">{{ __('Close panel') }}</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col justify-between dark:bg-slate-600">
                            <div class="p-4 sm:p-6 dark:bg-slate-600">
                                <div>
                                    <!-- File drop -->
                                    <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-md"
                                        x-bind:class="{
                                            'border-slate-300': ! dropping,
                                            'border-slate-400': dropping,
                                        }"
                                        x-on:dragover.prevent="dropping = true"
                                        x-on:dragleave.prevent="dropping = false"
                                        x-on:drop="dropping = false"
                                        x-on:drop.prevent="handleDrop($event)"
                                        x-data="{
                                            dropping: false,

                                            handleDrop(event) {
                                                @this.upload('file', event.dataTransfer.files[0])
                                            }
                                        }"
                                    >
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                            <div class="flex text-sm text-slate-600 dark:text-slate-300">
                                                <label for="file" class="relative cursor-pointer bg-white dark:bg-slate-600 rounded-md font-medium text-teal-600 dark:text-cyan-300 dark:hover:text-cyan-600 hover:text-teal-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-teal-500 dark:focus-within:ring-blue-300">
                                                    <span>{{ __('Upload a file') }}</span>
                                                    <input id="file" wire:model="file" name="file" type="file" class="sr-only">
                                                </label>
                                                <p class="pl-1 dark:text-slate-300">{{ __('or drag and drop') }}</p>
                                            </div>
                                            <p class="text-xs text-slate-500 dark:text-slate-300">
                                                {{ __('CSV file up to :size', [
                                                    'size' => $fileSize,
                                                ]) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @error('file')
                                    <span class="mt-2 text-red-500 font-medium text-sm dark:text-red-200">{{ $message }}</span>
                                @enderror
                                <!-- End file drop -->

                                <!-- Column selection -->
                                {{-- If file uloaded --}}
                                @if ($fileHeaders)
                                    <div class="mt-8">
                                        <h2 class="font-medium dark:text-slate-200">{{ __('Match columns')}}</h2>

                                        <div class="mt-4 space-y-5">
                                            @foreach ($columnsToMap as $column => $value)
                                                <div class="grid grid-cols-4 gap-4 items-start">
                                                    <label for="{{ $column }}" class="block text-sm font-medium text-slate-700 dark:text-slate-200 sm:mt-px sm:pt-2 col-span-1">
                                                        {{ $columnLabels[$column] ?? ucfirst(str_replace(['_', '-'], ' ', $column)) }}
                                                        <span class="text-red-600 font-bold text-sm">
                                                            {{ in_array('columnsToMap.' . $column, array_keys($requiredColumns)) ? '*': ''}}
                                                        </span>
                                                    </label>
                                                    <div class="mt-1 sm:mt-0 sm:col-span-3">
                                                        <select wire:model.defer="columnsToMap.{{$column}}" type="text" name="{{ $column }}" id="{{ $column }}" class="max-w-lg block w-full dark:bg-slate-700 dark:text-white shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:max-w-xs sm:text-sm border-slate-300 rounded-md">
                                                            <option value="">{{ __('Select a column or keep if not required') }}</option>
                                                            @foreach ($fileHeaders as $k => $fileHeader)
                                                                <option value="{{$fileHeader}}" @if(Str::slug($fileHeader) ==  Str::slug($columnLabels[$column])) selected @endif>{{ $fileHeader }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('columnsToMap.' . $column)
                                                            <span class="mt-2 text-red-500 font-medium text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                {{-- Endif file uloaded --}}
                                <!-- End columns selection -->
                            </div>
                        </div>

                        <div class="overflow-y-auto">
                            <livewire:handle-imports :model="$model"/>
                        </div>

                        <div class="flex flex-shrink-0 justify-end px-4 py-4 dark:bg-slate-700">
                            <button type="submit" class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-teal-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 dark:bg-indigo-700 dark:text-white dark:hover:text-blue-300" {{ $fileRowCount === 0 ? 'disabled': ''}}>{{ __('Import') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
