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
            <div class="flex space-x-4 w-full">
                <div>
                    <x-avatar label="AB" />
                </div>
                <div class="w-full">
                    <div class="text-slate-800 font-bold">
                        {{ $notification->data['message'] }}
                    </div>
                    <div>
                        {{ $notification->data['message_long'] }}
                    </div>
                </div>
                <div>
                    {{ $notification->created_at->diffForHumans([
                        'parts' => 1,
                        'join' => '',
                        'short' => true
                    ]) }}
                </div>
            </div>
        </x-dropdown.item>
    @empty
        <x-dropdown.item>
            @lang('There are no new notifications')
        </x-dropdown.item>
    @endforelse
</x-dropdown>
