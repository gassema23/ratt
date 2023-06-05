<div class="grid grid-cols-6 gap-4">
    <div class="col-span-6 md:col-span-2 2xl:col-span-1">
        <div class="flex space-y-4 flex-col">
            <x-card>
                <ul class="space-y-1">
                    @foreach ($systems as $system)
                        <li>
                            <a href="#" wire:click="openSection('{{$system->id}}')"
                                class="@if ($openSection === '{{$system->id}}') text-teal-600 bg-teal-50 @endif flex items-center py-2 px-4 text-slate-800 hover:text-teal-600 hover:bg-teal-50 w-full justify-between transition-all duration-300 ease-in-out">
                                {{ $system->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </x-card>
        </div>
    </div>
    <div class="col-span-6 md:col-span-4 2xl:col-span-5">
        <div wire:loading class="flex w-full transition ease-in-out duration-500">
            <x-card>
                <div class="flex justify-start w-full pb-2 -mb-px">
                    <svg class="animate-spin w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </x-card>
        </div>
        <div wire:loading.remove>
        </div>
    </div>
</div>
