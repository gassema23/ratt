<x-dropdown width="w-max ">
    <x-slot name="trigger" class="relative">
        <x-icon name="bell" class="w-6 h-6" />
        @if ($notifications->count() > 0)
            <span
                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $notifications->count() }}
            </span>
        @endif
    </x-slot>
    @forelse ($notifications as $notification)
        <x-dropdown.item wire:click="see('{{ $notification->id }}')">
            <div class="flex items-center">
                <p class="text-gray-600 text-sm mx-2">
                    <span class="font-bold">{{ $notification->data['message'] }}</span>
                    {{ $notification->data['message_long'] }}
                </p>
            </div>
        </x-dropdown.item>
    @empty
        <x-dropdown.item>
            @lang('There are no new notifications')
        </x-dropdown.item>
    @endforelse
</x-dropdown>
