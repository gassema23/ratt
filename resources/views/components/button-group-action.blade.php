@if (isset($permissions))
    <x-dropdown width="w-fit">
        <x-dropdown.header :label="__('Manage') . ' ' . $title" class="px-4">
            @can($permissions . '-view')
                @if (isset($show))
                    <x-dropdown.item href="{{ route($show, $id) }}" :label="__('Show')" />
                @endif
            @endcan
            @can($permissions . '-history')
                @if (isset($archive))
                    <x-dropdown.item :label="__('History')"
                        wire:click.prevent="$emit('openModal','{{ $archive }}', [{{ json_encode($id) }}])" />
                @endif
            @endcan
            @can($permissions . '-edit')
                @if (isset($edit))
                    <x-dropdown.item wire:click.prevent="$emit('openModal','{{ $edit }}', [{{ json_encode($id) }}])"
                        :label="__('Edit')" />
                @endif
            @endcan
            @can($permissions . '-edit')
                @if (isset($member))
                    <x-dropdown.item wire:click.prevent="$emit('openModal','{{ $member }}', [{{ json_encode($id) }}])" :label="__('Member')" />
                @endif
            @endcan
            @can($permissions . '-delete')
                @if (isset($delete))
                    <x-dropdown.item :label="__('Desactivate')" wire:click.prevent="confirm({{ $id }})" />
                @endif
            @endcan
            @can($permissions . '-restore')
                @if (isset($restore))
                    <x-dropdown.item :label="__('Restore')"
                        wire:click.prevent="$emit('openModal','{{ $restore }}', [{{ json_encode($id) }}])" />
                @endif
            @endcan
        </x-dropdown.header>
    </x-dropdown>
@endif
