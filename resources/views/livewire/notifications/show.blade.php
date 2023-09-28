<x-dropdown width="w-max">
    <x-slot name="trigger" class="relative">
        <x-icon name="bell" class="w-6 h-6" />
        @if ($notifications->count() > 0)
            <div class="absolute -top-1 -right-0.5">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                </span>
            </div>
        @endif
    </x-slot>
    @forelse ($notifications as $notification)
        <x-dropdown.item wire:click="see('{{ $notification->id }}')" @class([
            'mb-2',
            'border-l-4 border-sky-500' => $notification->data['type'] == 'info',
            'border-l-4 border-rose-500' => $notification->data['type'] == 'error',
            'border-l-4 border-teal-500' => $notification->data['type'] == 'success',
            'border-l-4 border-slate-100' =>
                $notification->data['type'] != 'info' &&
                $notification->data['type'] != 'success' &&
                $notification->data['type'] != 'error',
        ])>
            <div @class(['flex', 'space-x-4', 'w-full'])>
                <div>
                    @if (isset($notification->data['created_by']))
                        <x-avatar
                            src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($notification->data['created_by']['email']))) }}"
                            size="w-16" />
                    @endif
                </div>
                <div class="w-full">
                    <div @class(['text-slate-800', 'font-bold'])>
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
                        'short' => true,
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
