@props(['header', 'footer'])
<div>
    <x-card >
        <div class="flex justify-between">
            <div class="font-bold text-slate-600 text-lg">{{ $title }}</div>
            @if (isset($header))
                {{ $header }}
            @endif
        </div>
        <div class="my-2">
            {{ $slot }}
        </div>
        @if (isset($footer))
            {{ $footer }}
        @endif
    </x-card>
</div>
