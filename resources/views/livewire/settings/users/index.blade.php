<div>
    <x-slot name="sidebar">
        <x-card>
            @livewire('settings.users.filter')
        </x-card>
    </x-slot>
    <x-card>
        @livewire('settings.users.table')
    </x-card>
</div>
