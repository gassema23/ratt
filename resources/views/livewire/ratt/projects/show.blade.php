<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($project->networks as $network)
            <x-app-card :title="$network->network_no">
                @can('networks-view', 'networks-edit', 'networks-delete')
                    <x-slot name="header">
                        <div class="flex items-center align-middle space-x-2">
                            <x-dropdown align="left">
                                <x-dropdown.header :label="trans('Manage networks')">
                                    <x-slot name="trigger">
                                        <x-icon name="dots-horizontal" class="w-4 h-4" />
                                    </x-slot>
                                    @can('networks-view')
                                        <x-dropdown.item :label="trans('Show')"
                                            href="{{ route('admin.ratt.networks.show', $network->id) }}" />
                                    @endcan
                                    @can('networks-edit')
                                        <x-dropdown.item href="#" :label="trans('Edit')"
                                            onclick="Livewire.emit('openModal', 'ratt.networks.edit', {{ json_encode([$network->id]) }})" />
                                    @endcan
                                    @can('networks-delete')
                                        <x-dropdown.item :label="trans('Delete')" wire:click.prevent="confirm({{ $network->id }})" />
                                    @endcan
                                </x-dropdown.header>
                            </x-dropdown>
                            @if (is_null($network->followersUsers()))
                                <x-button.circle icon="heart" xs negative outline
                                    wire:click.prevent="acceptFollow({{ $network }})" />
                            @else
                                <x-button.circle icon="heart" xs negative
                                    wire:click.prevent="acceptUnfollow({{ $network }})" />
                            @endif
                        </div>
                    </x-slot>
                @endcan
                <div class="flex flex-col space-y-3">
                    <div class="flex align-middle items-center">
                        <div class="mr-4">
                            <x-icon name="location-marker" class="w-5 h-5" />
                        </div>
                        <div class="text-sm">{!! $network->locations !!}</div>
                    </div>
                    <div class="flex align-middle items-center">
                        <div class="mr-4">
                            <x-icon name="clipboard-list" class="w-5 h-5" />
                        </div>
                        <div>{{ $network->network_element }}</div>
                    </div>
                    <div class="flex align-middle items-center">
                        <div class="mr-4">
                            <x-icon name="calendar" class="w-5 h-5" />
                        </div>
                        <div>{{ $network->ended_at->toFormattedDateString() }}</div>
                    </div>
                </div>
            </x-app-card>
        @empty
            <x-empty-data :name="trans('Networks')" />
        @endforelse
    </div>
</div>
