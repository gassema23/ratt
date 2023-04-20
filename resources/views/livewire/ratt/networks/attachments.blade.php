<div>
    <ul class="flex flex-col divide-y divide-slate-200 text-xs">
        @forelse ($files as $file)
            <li class="inline-flex items-center gap-x-2 py-1.5 px-2 font-medium text-slate-500">
                <div class=" flex justify-between w-full">
                    <div wire:click="download({{ $file->id }})" class="text-teal-500 hover:underline cursor-pointer">
                        <img src="https://pro.alchemdigital.com/api/extension-image/{{ pathinfo($file->file_name, PATHINFO_EXTENSION) }}"
                            class="inline-block mr-2" />
                        {{ $file->file_name }}
                    </div>
                    <div>
                        @can('destroy', $file)
                            <x-button xs negative squared flat icon="trash"
                                wire:click.prevent="confirm({{ json_encode($file) }})" />
                        @endcan
                    </div>
                </div>
            </li>
        @empty
            <li class="inline-flex items-center gap-x-2 py-1 px-1.5 font-medium text-slate-500 ">
                @lang('No file attached')
            </li>
        @endforelse
    </ul>
</div>
