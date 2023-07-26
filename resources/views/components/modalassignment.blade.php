<x-button xs squared teal icon="user-add" onclick="Livewire.emit('openModal', '{{ $route }}', {{ json_encode([$id]) }})" :key="time().$id" id="modalrecord-{{ $id }}"/>
