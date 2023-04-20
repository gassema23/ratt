<div>
    <div class="flex justify-end space-x-4 mb-4">
        @can('technologies-create')
            <a href="#" class="text-teal-500 hover:underline uppercase text-sm"
                wire:click="$emit('openModal', 'settings.technologies.create')">
                <x-icon name="plus-circle" class="w-4 h-4 inline-block" /> @lang('New technology')
            </a>
        @endcan
    </div>
</div>
<x-card>
    @livewire('settings.technologies.table')
</x-card>
