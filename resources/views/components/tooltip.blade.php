<span x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
    class="mr-2 w-5 cursor-pointer items-center flex">
    <x-icon name="exclamation-circle" class="w-4 text-yellow-500" />
    <div x-show="tooltip"
        class="text-sm text-amber-500 absolute bg-amber-100 border-amber-500 rounded shadow
    font-semibold px-2.5 py-0.5 transform -translate-y-4 translate-x-4">
        {{ $slot }}
    </div>
</span>
